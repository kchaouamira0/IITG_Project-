<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Direction;
use App\Form\DirectionType;
use App\Repository\DirectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/direction")
 */
class DirectionController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_direction_index", methods={"GET"})
     */
    public function index(DirectionRepository $directionRepository): Response {

        $direction = $directionRepository->find(1);
        if (!$direction) {
            return $this->redirectToRoute('app_iitg_admin_direction_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('iitg_admin/direction/index.html.twig', [
                    'direction' => $direction,
        ]);
    }

    /**
     * @Route("/edit", name="app_iitg_admin_direction_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DirectionRepository $directionRepository): Response {

        $direction = $directionRepository->find(1);
        if (!$direction) {
            $direction = new Direction();
        }
        $form = $this->createForm(DirectionType::class, $direction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           // dump($direction);
            $directionRepository->add($direction, true);

            return $this->redirectToRoute('app_iitg_admin_direction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/direction/edit.html.twig', [
                    'direction' => $direction,
                    'form' => $form,
        ]);
    }

}
