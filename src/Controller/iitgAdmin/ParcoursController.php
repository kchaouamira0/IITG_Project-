<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/parcours")
 */
class ParcoursController extends AbstractController
{
    /**
     * @Route("/", name="app_iitg_admin_parcours_index", methods={"GET"})
     */
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('iitg_admin/parcours/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_parcours_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ParcoursRepository $parcoursRepository): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_iitg_admin_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/parcours/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_parcours_show", methods={"GET"})
     */
    public function show(Parcours $parcour): Response
    {
        return $this->render('iitg_admin/parcours/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_parcours_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_iitg_admin_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/parcours/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_parcours_delete", methods={"POST"})
     */
    public function delete(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcour->getId(), $request->request->get('_token'))) {
            $parcoursRepository->remove($parcour, true);
        }

        return $this->redirectToRoute('app_iitg_admin_parcours_index', [], Response::HTTP_SEE_OTHER);
    }
}
