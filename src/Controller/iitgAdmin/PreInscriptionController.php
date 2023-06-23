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
use App\Service\PdfGenerator;

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
        return $this->redirectToRoute('app_iitg_admin_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
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
    public function attestationMethode1(PreInscription $preInscription): Response {


        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->setIsRemoteEnabled(true);

        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('iitg_admin/pre_inscription/pdf.html.twig', ['preInscription' => $preInscription
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
     * @Route("/pdf/attestation-methode-2/{id}", name="app_iitg_admin_pre_inscription_exemple_attestation_methode_2", methods={"GET"})
     */
    public function attestationMethode2(PdfGenerator $pdfGenerator) {
        $title = 'PDF Example';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Sed auctor lectus id mi lacinia, id eleifend tellus tempor. 
        Nulla sit amet sapien quis turpis aliquam laoreet vitae in ex. 
        Donec vitae felis nec lectus aliquet finibus. 
        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.';

        // Generate the PDF
        $pdfContent = $pdfGenerator->generatePDF($title, $text);

        // Create a response with the PDF content
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }

}
