<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index()
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        return $this->render('post/index.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/posts/show/{id}", name="posts.show")
     */
    public function show($id)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        return $this->render('post/show.html.twig', ['post' => $post]);
    }
}
