<?php

namespace App\Controller\iitgAdmin;

use App\Entity\AcademicYear;
use App\Form\AcademicYearType;
use App\Repository\AcademicYearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/academic-year")
 */
class AcademicYearController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_academic_year_index", methods={"GET"})
     */
    public function index(AcademicYearRepository $academicYearRepository): Response {
        return $this->render('iitg_admin/academic_year/index.html.twig', [
                    'academic_years' => $academicYearRepository->findBy([], ['value' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_academic_year_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AcademicYearRepository $academicYearRepository): Response {
        $academicYear = new AcademicYear();
        $form = $this->createForm(AcademicYearType::class, $academicYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $years = $academicYearRepository->findAll();
            if ($academicYear->isCurrent()) {
                foreach ($years as $year) {
                    $year->setCurrent(false);
                    $academicYearRepository->add($year, true);
                }
            }
            $academicYearRepository->add($academicYear, true);

            return $this->redirectToRoute('app_iitg_admin_academic_year_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/academic_year/new.html.twig', [
                    'academic_year' => $academicYear,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_academic_year_show", methods={"GET"})
     */
    public function show(AcademicYear $academicYear): Response {
        return $this->render('iitg_admin/academic_year/show.html.twig', [
                    'academic_year' => $academicYear,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_academic_year_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AcademicYear $academicYear, AcademicYearRepository $academicYearRepository): Response {
        $form = $this->createForm(AcademicYearType::class, $academicYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $years = $academicYearRepository->findAll();
            if ($academicYear->isCurrent()) {
                foreach ($years as $year) {
                    if ($year->getId() !== $academicYear->getId()) {
                        $year->setCurrent(false);
                        $academicYearRepository->add($year, true);
                    }
                }
            }
            $academicYearRepository->add($academicYear, true);

            return $this->redirectToRoute('app_iitg_admin_academic_year_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/academic_year/edit.html.twig', [
                    'academic_year' => $academicYear,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_academic_year_delete", methods={"POST"})
     */
    public function delete(Request $request, AcademicYear $academicYear, AcademicYearRepository $academicYearRepository): Response {
        if ($this->isCsrfTokenValid('delete' . $academicYear->getId(), $request->request->get('_token'))) {
            $academicYearRepository->remove($academicYear, true);
        }

        return $this->redirectToRoute('app_iitg_admin_academic_year_index', [], Response::HTTP_SEE_OTHER);
    }

}
