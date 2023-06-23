<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

/**
 * @Route("/post")
 */
class PostController extends AbstractController {

    /**
     * @Route("/news_for_index", name="app_iitg_news_for_index")
     */
    public function index(PostRepository $postRepository): Response {
        $posts = $postRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('post/newsInIndex.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/{slug}", name="app_iitg_news_by_slug")
     */
    public function newsBySlug($slug, PostRepository $postRepository): Response {
        $post = $postRepository->findOneBySlug($slug);
        return $this->render('post/newsPage.html.twig', ['post' => $post]);
    }

}
