<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/speciality")
 */
class SpecialityController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_speciality_index", methods={"GET"})
     */
    public function index(SpecialityRepository $specialityRepository): Response {
        return $this->render('iitg_admin/speciality/index.html.twig', [
                    'specialities' => $specialityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_speciality_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SpecialityRepository $specialityRepository): Response {
        $speciality = new Speciality();
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialityRepository->add($speciality, true);

            return $this->redirectToRoute('app_iitg_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/speciality/new.html.twig', [
                    'speciality' => $speciality,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_speciality_show", methods={"GET"})
     */
    public function show(Speciality $speciality): Response {
        return $this->render('iitg_admin/speciality/show.html.twig', [
                    'speciality' => $speciality,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_speciality_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Speciality $speciality, SpecialityRepository $specialityRepository): Response {
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialityRepository->add($speciality, true);

            return $this->redirectToRoute('app_iitg_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/speciality/edit.html.twig', [
                    'speciality' => $speciality,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_speciality_delete", methods={"POST"})
     */
    public function delete(Request $request, Speciality $speciality, SpecialityRepository $specialityRepository): Response {
        if ($this->isCsrfTokenValid('delete' . $speciality->getId(), $request->request->get('_token'))) {
            $specialityRepository->remove($speciality, true);
        }

        return $this->redirectToRoute('app_iitg_admin_speciality_index', [], Response::HTTP_SEE_OTHER);
    }

}
