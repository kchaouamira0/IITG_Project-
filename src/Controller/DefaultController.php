<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/", name="app_iitg")
     */
    public function index(): Response {

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/a-propos-de-nous", name="app_iitg_about")
     */
    public function about(): Response {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/missions", name="app_iitg_missions")
     */
    public function missions(): Response {
        return $this->render('default/missions.html.twig');
    }

    /**
     * @Route("/academic-cooperation", name="app_iitg_Academic_Cooperation")
     */
    public function academicCooperation(): Response {
        return $this->render('default/academicCooperation.html.twig');
    }

    /**
     * @Route("/admissions", name="app_iitg_admissions")
     */
    public function admissions(): Response {
        return $this->render('default/admissions.html.twig');
    }

    /**
     * @Route("/contact-us", name="app_iitg_contact_us")
     */
    public function contactUs(): Response {
        return $this->render('default/contactUs.html.twig');
    }

    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request) {
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);

        //        // On revient sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }

}
