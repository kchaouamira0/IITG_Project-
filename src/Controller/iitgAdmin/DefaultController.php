<?php

namespace App\Controller\iitgAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_default")
     */
    public function index(): Response {
        return $this->render('iitg_admin/default/index.html.twig', [
                    'controller_name' => 'DefaultController',
        ]);
    }

}
