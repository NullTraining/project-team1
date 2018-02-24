<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostController
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/posts", name="posts.index")
     * @Template("post/index.html.twig")
     */
    public function index()
    {
        $posts = $this->postRepository->findAll();

        return  ['posts' => $posts];
    }

    /**
     * @Route("/posts/show/{id}", name="posts.show")
     * @Template("post/show.html.twig")
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        return ['post' => $post];
    }
}
