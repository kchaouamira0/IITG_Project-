<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PreInscriptionRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PreInscription;
use App\Form\PreInscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\OpenPreInscription;

/**
 * @Route("/pre-inscription")
 */
class PreInscriptionController extends AbstractController {

    /**
     * @Route("/", name="app_pre_inscription")
     */
    public function index(Request $request, PreInscriptionRepository $preInscriptionRepository, EntityManagerInterface $entityManager): Response {

        /**
         * Return open pre-inscription current
         */
        $openPreInscription = OpenPreInscription::getInstanceOfOpenPreInscriptionCurrent($entityManager);
        if (!$openPreInscription) {
            return $this->redirectToRoute('app_iitg', [], Response::HTTP_SEE_OTHER);
        }

        $preInscription = new PreInscription();
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $preInscription->setIsAccepted(false);
            $preInscription->setOpenPreInscription($openPreInscription);
            $preInscriptionRepository->add($preInscription, true);
            $this->addFlash('success', 'Your message has been successfully sent');
            return $this->redirectToRoute('app_pre_inscription', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('pre_inscription/index.html.twig', ['form' => $form->createView(),'openPreInscription'=>$openPreInscription]);
    }

}
