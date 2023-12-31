<?php

namespace App\Controller\iitgAdmin;

use App\Entity\PreInscription;
use App\Form\PreInscription1Type;
use App\Repository\PreInscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Direction;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\OpenPreInscription;

/**
 * @Route("/iitg-admin/pre-inscription")
 */
class PreInscriptionController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_pre_inscription_index", methods={"GET"})
     */
    public function index(PreInscriptionRepository $preInscriptionRepository): Response {
        return $this->render('iitg_admin/pre_inscription/index.html.twig', [
                    'pre_inscriptions' => $preInscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/open-inscription/{id}", name="app_iitg_admin_pre_inscription_by_open_inscription", methods={"GET"})
     */
    public function openInscription(PreInscriptionRepository $preInscriptionRepository, OpenPreInscription $openPreInscription): Response {
        if (!$openPreInscription) {
            return $this->createNotFoundException("openPreInscription existe pas");
        }

        return $this->render('iitg_admin/pre_inscription/index.html.twig', [
                    'pre_inscriptions' => $preInscriptionRepository->findBy(['openPreInscription' => $openPreInscription]),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_pre_inscription_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PreInscriptionRepository $preInscriptionRepository): Response {
        $preInscription = new PreInscription();
        $form = $this->createForm(PreInscription1Type::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preInscriptionRepository->add($preInscription, true);

            return $this->redirectToRoute('app_iitg_admin_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/pre_inscription/new.html.twig', [
                    'pre_inscription' => $preInscription,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_pre_inscription_show", methods={"GET"})
     */
    public function show(PreInscription $preInscription): Response {
        return $this->render('iitg_admin/pre_inscription/show.html.twig', [
                    'pre_inscription' => $preInscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_pre_inscription_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response {
        $form = $this->createForm(PreInscription1Type::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preInscriptionRepository->add($preInscription, true);

            return $this->redirectToRoute('app_iitg_admin_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/pre_inscription/edit.html.twig', [
                    'pre_inscription' => $preInscription,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_pre_inscription_delete", methods={"POST"})
     */
    public function delete(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response {
        if ($this->isCsrfTokenValid('delete' . $preInscription->getId(), $request->request->get('_token'))) {
            $preInscriptionRepository->remove($preInscription, true);
        }

        return $this->redirectToRoute('app_iitg_admin_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/accept/{id}", name="app_iitg_admin_pre_inscription_accept", methods={"GET", "POST"})
     */
    public function accept(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response {
        $preInscription->setIsAccepted(true);
        $preInscriptionRepository->add($preInscription, true);
        return $this->redirectToRoute('app_iitg_admin_open_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/pdf/affiche", name="app_iitg_admin_pre_inscription_exemple_pdf", methods={"GET"})
     */
    public function pdf(): Response {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('iitg_admin/pre_inscription/pdf.html.twig', ['title' => "Welcome to our PDF Test"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * @Route("/pdf2/affiche", name="app_iitg_admin_pre_inscription_exemple_pdf2", methods={"GET"})
     */
    public function pdf2(): Response {
        return $this->render('iitg_admin/pre_inscription/pdf.html.twig', ['title' => "Welcome to our PDF Test"]);
    }

    /**
     * @Route("/pdf/attestation-methode-1/{id}", name="app_iitg_admin_pre_inscription_exemple_attestation_methode_1", methods={"GET"})
     */
    public function attestationMethode1(PreInscription $preInscription, EntityManagerInterface $entityManager): Response {

        $direction = Direction::getInstance($entityManager);
        $openPreInscription = OpenPreInscription::getInstanceOfOpenPreInscriptionCurrent($entityManager);
        if (!$openPreInscription) {
            return $this->createNotFoundException("openPreInscription null");
        }

        $preInscriptions = $openPreInscription->getPreInscriptions();
        $annee_univ = $openPreInscription->getAcademicYear();

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->setIsRemoteEnabled(true);

        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('iitg_admin/pre_inscription/pdf.html.twig',
                [
                    'preInscription' => $preInscription,
                    'direction' => $direction,
                    'annee_univ' => $annee_univ
                ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);

        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * @Route("/pdf/all-attestations", name="app_iitg_admin_pre_inscription_all_attestations", methods={"GET"})
     */
    public function allAttestation(PreInscriptionRepository $preInscriptionRepository, EntityManagerInterface $entityManager): Response {

        $direction = Direction::getInstance($entityManager);
        $openPreInscription = OpenPreInscription::getInstanceOfOpenPreInscriptionCurrent($entityManager);
        if (!$openPreInscription) {
            return $this->createNotFoundException("openPreInscription null");
        }

        $preInscriptions = $openPreInscription->getPreInscriptions();
        $annee_univ = $openPreInscription->getAcademicYear();
        $html = "";
        $dompdf = null;
        foreach ($preInscriptions as $preInscription) {
            // Configure Dompdf according to your needs
            if ($preInscription->isIsAccepted()) {
                $pdfOptions = new Options();
                $pdfOptions->setIsRemoteEnabled(true);

                $pdfOptions->set('defaultFont', 'Arial');

                // Instantiate Dompdf with our options
                $dompdf = new Dompdf($pdfOptions);

                // Retrieve the HTML generated in our twig file
                $html = $html . $this->renderView('iitg_admin/pre_inscription/pdf.html.twig', [
                            'preInscription' => $preInscription,
                            'direction' => $direction,
                            'annee_univ' => $annee_univ
                ]);
            }
        }

        if ($dompdf) {
            // Load HTML to Dompdf
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser (force download)
            $dompdf->stream("mypdf.pdf", [
                "Attachment" => false
            ]);

            return new Response('', 200, [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            return $this->redirectToRoute('app_iitg_admin_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
        }
    }

}
