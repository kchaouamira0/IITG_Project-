<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Institut;
use App\Form\InstitutType;
use App\Repository\InstitutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/institut")
 */
class InstitutController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_institut_index", methods={"GET"})
     */
    public function index(InstitutRepository $institutRepository): Response {
        $institut = $institutRepository->find(1);
        if (!$institut) {
            return $this->redirectToRoute('app_iitg_admin_institut_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('iitg_admin/institut/index.html.twig', ['institut' => $institut]);
    }

    /**
     * @Route("/edit", name="app_iitg_admin_institut_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InstitutRepository $institutRepository): Response {
        $institut = $institutRepository->find(1);
        if (!$institut) {
            $institut = new Institut();
        }

        $form = $this->createForm(InstitutType::class, $institut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $institutRepository->add($institut, true);

            return $this->redirectToRoute('app_iitg_admin_institut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/institut/edit.html.twig', [
                    'institut' => $institut,
                    'form' => $form,
        ]);
    }

}
