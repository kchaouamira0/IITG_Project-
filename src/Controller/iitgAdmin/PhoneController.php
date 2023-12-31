<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Phone;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg/admin/phone")
 */
class PhoneController extends AbstractController
{
    /**
     * @Route("/", name="app_iitg_admin_phone_index", methods={"GET"})
     */
    public function index(PhoneRepository $phoneRepository): Response
    {
        return $this->render('iitg_admin/phone/index.html.twig', [
            'phones' => $phoneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_phone_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PhoneRepository $phoneRepository): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phoneRepository->add($phone, true);

            return $this->redirectToRoute('app_iitg_admin_phone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/phone/new.html.twig', [
            'phone' => $phone,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_phone_show", methods={"GET"})
     */
    public function show(Phone $phone): Response
    {
        return $this->render('iitg_admin/phone/show.html.twig', [
            'phone' => $phone,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_phone_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Phone $phone, PhoneRepository $phoneRepository): Response
    {
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $phoneRepository->add($phone, true);

            return $this->redirectToRoute('app_iitg_admin_phone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/phone/edit.html.twig', [
            'phone' => $phone,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_phone_delete", methods={"POST"})
     */
    public function delete(Request $request, Phone $phone, PhoneRepository $phoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$phone->getId(), $request->request->get('_token'))) {
            $phoneRepository->remove($phone, true);
        }

        return $this->redirectToRoute('app_iitg_admin_phone_index', [], Response::HTTP_SEE_OTHER);
    }
}
