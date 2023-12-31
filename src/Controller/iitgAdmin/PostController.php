<?php

namespace App\Controller\iitgAdmin;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gedmo\Sluggable\Util\Urlizer;

/**
 * @Route("/iitg-admin/post")
 */
class PostController extends AbstractController {

    /**
     * @Route("/", name="app_iitg_admin_post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response {
        return $this->render('iitg_admin/post/index.html.twig', [
                    'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iitg_admin_post_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PostRepository $postRepository): Response {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postRepository->add($post, true);

            return $this->redirectToRoute('app_iitg_admin_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/post/new.html.twig', [
                    'post' => $post,
                    'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iitg_admin_post_show", methods={"GET"})
     */
    public function show(Post $post): Response {
        return $this->render('iitg_admin/post/show.html.twig', [
                    'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iitg_admin_post_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Post $post, PostRepository $postRepository): Response {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postRepository->add($post, true);

            return $this->redirectToRoute('app_iitg_admin_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iitg_admin/post/new.html.twig', [
                    'post' => $post,
                    'form' => $form,
                    'edit' => true
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_iitg_admin_post_delete")
     */
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response {
        //   if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
        $postRepository->remove($post, true);
        //}

        return $this->redirectToRoute('app_iitg_admin_post_index', [], Response::HTTP_SEE_OTHER);
    }

}
