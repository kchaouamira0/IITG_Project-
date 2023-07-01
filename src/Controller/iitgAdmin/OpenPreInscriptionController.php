<?php

namespace App\Controller\iitgAdmin;

use App\Entity\OpenPreInscription;
use App\Form\OpenPreInscriptionType;
use App\Repository\OpenPreInscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/open-pre-inscription")
 */
class OpenPreInscriptionController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_open_pre_inscription_index", methods={"GET"})
     */
    public function index(OpenPreInscriptionRepository $openPreInscriptionRepository): Response {
        return $this->render('iitg_admin/open_pre_inscription/index.html.twig', [
                    'open_pre_inscriptions' => $openPreInscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_open_pre_inscription_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OpenPreInscriptionRepository $openPreInscriptionRepository): Response {
        $openPreInscription = new OpenPreInscription();
        $form = $this->createForm(OpenPreInscriptionType::class, $openPreInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $opens = $openPreInscriptionRepository->findAll();
            if ($openPreInscription->isCurrent()) {
                foreach ($opens as $open) {
                    $open->setCurrent(false);
                    $openPreInscriptionRepository->add($open, true);
                }
            }

            $openPreInscriptionRepository->add($openPreInscription, true);

            return $this->redirectToRoute('app_iitg_admin_open_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/open_pre_inscription/new.html.twig', [
                    'open_pre_inscription' => $openPreInscription,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_open_pre_inscription_show", methods={"GET"})
     */
    public function show(OpenPreInscription $openPreInscription): Response {
        return $this->render('iitg_admin/open_pre_inscription/show.html.twig', [
                    'open_pre_inscription' => $openPreInscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_open_pre_inscription_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, OpenPreInscription $openPreInscription, OpenPreInscriptionRepository $openPreInscriptionRepository): Response {
        $form = $this->createForm(OpenPreInscriptionType::class, $openPreInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($openPreInscription->isCurrent()) {
                $opens_inscriptions = $openPreInscriptionRepository->findAll();
                foreach ($opens_inscriptions as $open) {
                    if ($open->getId() !== $openPreInscription->getId()) {
                        $open->setCurrent(false);
                        $openPreInscriptionRepository->add($open, true);
                    }
                }
            }


            $openPreInscriptionRepository->add($openPreInscription, true);

            return $this->redirectToRoute('app_iitg_admin_open_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/open_pre_inscription/edit.html.twig', [
                    'open_pre_inscription' => $openPreInscription,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_iitg_admin_open_pre_inscription_delete")
     */
    public function delete(Request $request, OpenPreInscription $openPreInscription, OpenPreInscriptionRepository $openPreInscriptionRepository): Response {
        $openPreInscriptionRepository->remove($openPreInscription, true);
        return $this->redirectToRoute('app_iitg_admin_open_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
    }

}
