<?php

namespace App\Controller\iitgAdmin;

use App\Entity\TypePost;
use App\Form\TypePostType;
use App\Repository\TypePostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iitg-admin/type-post")
 */
class TypePostController extends AbstractController
{
    /**
     * @Route("/", name="app_iitg_admin_type_post_index", methods={"GET"})
     */
    public function index(TypePostRepository $typePostRepository): Response
    {
        return $this->render('iitg_admin/type_post/index.html.twig', [
            'type_posts' => $typePostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_type_post_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypePostRepository $typePostRepository): Response
    {
        $typePost = new TypePost();
        $form = $this->createForm(TypePostType::class, $typePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typePostRepository->add($typePost, true);

            return $this->redirectToRoute('app_iitg_admin_type_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/type_post/new.html.twig', [
            'type_post' => $typePost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_type_post_show", methods={"GET"})
     */
    public function show(TypePost $typePost): Response
    {
        return $this->render('iitg_admin/type_post/show.html.twig', [
            'type_post' => $typePost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_type_post_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypePost $typePost, TypePostRepository $typePostRepository): Response
    {
        $form = $this->createForm(TypePostType::class, $typePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typePostRepository->add($typePost, true);

            return $this->redirectToRoute('app_iitg_admin_type_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/type_post/edit.html.twig', [
            'type_post' => $typePost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_type_post_delete", methods={"POST"})
     */
    public function delete(Request $request, TypePost $typePost, TypePostRepository $typePostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typePost->getId(), $request->request->get('_token'))) {
            $typePostRepository->remove($typePost, true);
        }

        return $this->redirectToRoute('app_iitg_admin_type_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
