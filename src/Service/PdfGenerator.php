<?php

namespace App\Service;

use TCPDF;

/**
 * Description of PdfGenerator
 *
 * @author Ahmed
 */
class PdfGenerator {

    private $pdf;

    public function __construct() {
        $this->pdf = new TCPDF();
    }

    public function generatePDF($title, $text) {
        // Ajouter une page
        $pdf->AddPage();

// Définir l'en-tête
        $pdf->SetHeaderData('http://127.0.0.1:8000/assets/iitg/img/exp/logo.png', 30, '', '', array(0, 0, 0), array(255, 255, 255));

// Définir le contenu de l'en-tête
        $pdf->SetHeaderContents(10, '<h1>Titre de l\'en-tête</h1><p>Texte de plusieurs lignes à gauche</p>');

// Afficher le contenu du document
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Write(10, 'Contenu du document...');

        // Output the PDF as a string
        return $this->pdf->Output('example.pdf', 'S');
    }

}
