<?php

namespace App\Controller\iitgAdmin;

use App\Entity\FiliereByParcours;
use App\Form\FiliereByParcoursType;
use App\Repository\FiliereByParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Entity\Filiere;
use App\Entity\Parcours;

/**
 * @Route("/iitg-admin/filiere-by-parcours")
 */
class FiliereByParcoursController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_filiere_by_parcours_index", methods={"GET"})
     */
    public function index(FiliereByParcoursRepository $filiereByParcoursRepository): Response {
        return $this->render('iitg_admin/filiere_by_parcours/index.html.twig', [
                    'filiere_by_parcours' => $filiereByParcoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_filiere_by_parcours_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FiliereByParcoursRepository $filiereByParcoursRepository): Response {
        $filiereByParcour = new FiliereByParcours();
        $form = $this->createForm(FiliereByParcoursType::class, $filiereByParcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filiereByParcoursRepository->add($filiereByParcour, true);

            return $this->redirectToRoute('app_iitg_admin_filiere_by_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/filiere_by_parcours/new.html.twig', [
                    'filiere_by_parcour' => $filiereByParcour,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_filiere_by_parcours_show", methods={"GET"})
     */
    public function show(FiliereByParcours $filiereByParcour): Response {
        return $this->render('iitg_admin/filiere_by_parcours/show.html.twig', [
                    'filiere_by_parcour' => $filiereByParcour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_filiere_by_parcours_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FiliereByParcours $filiereByParcour, FiliereByParcoursRepository $filiereByParcoursRepository): Response {
        $form = $this->createForm(FiliereByParcoursType::class, $filiereByParcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filiereByParcoursRepository->add($filiereByParcour, true);

            return $this->redirectToRoute('app_iitg_admin_filiere_by_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/filiere_by_parcours/edit.html.twig', [
                    'filiere_by_parcour' => $filiereByParcour,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_filiere_by_parcours_delete", methods={"POST"})
     */
    public function delete(Request $request, FiliereByParcours $filiereByParcour, FiliereByParcoursRepository $filiereByParcoursRepository): Response {
        if ($this->isCsrfTokenValid('delete' . $filiereByParcour->getId(), $request->request->get('_token'))) {
            $filiereByParcoursRepository->remove($filiereByParcour, true);
        }

        return $this->redirectToRoute('app_iitg_admin_filiere_by_parcours_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * ADD MANY METHODS
     */

    /**
     * @Route("/new-parcours-for-filiere/{filiere_id}", name="app_iitg_admin_filiere_by_parcours_new_parcours_for_filiere", methods={"GET", "POST"})
     * @Entity("filiere", expr="repository.find(filiere_id)")
     */
    public function newParcours(Request $request, FiliereByParcoursRepository $filiereByParcoursRepository, Filiere $filiere): Response {


        $filiereByParcour = new FiliereByParcours();
        $filiereByParcour->setFiliere($filiere);
        $form = $this->createForm(FiliereByParcoursType::class, $filiereByParcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filiereByParcoursRepository->add($filiereByParcour, true);

            return $this->redirectToRoute('app_iitg_admin_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/filiere_by_parcours/new.html.twig', [
                    'filiere_by_parcour' => $filiereByParcour,
                    'form' => $form,
        ]);
    }

    /**
     * DELETE
     */

    /**
     * @Route("/delete-parcours-for-filiere/{filiere_id}/{{parcours_id}", name="app_iitg_admin_filiere_by_parcours_delete_parcours_for_filiere", methods={"GET", "POST"})
     * @Entity("filiere", expr="repository.find(filiere_id)")
     * @Entity("parcours", expr="repository.find(parcours_id)")
     */
    public function deleteParcoursForFiliere(Request $request, FiliereByParcoursRepository $filiereByParcoursRepository, Filiere $filiere, Parcours $parcours): Response {

        $filiereByParcours = $filiereByParcoursRepository->findOneBy([
            'filiere' => $filiere,
            'parcours' => $parcours,
        ]);

        $filiereByParcoursRepository->remove($filiereByParcours, true);
        return $this->redirectToRoute('app_iitg_admin_filiere_index', [], Response::HTTP_SEE_OTHER);
    }

}
