<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Post;
use App\Entity\PostComment;
use App\Repository\PostCommentRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostCommentRepositoryTest extends KernelTestCase
{
    /** @var PostRepository */
    private $repository;

    public function setup()
    {
        $kernel = self::bootKernel();

        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $em->getRepository(PostComment::class);
    }

    public function testRepositoryCanBeCreated()
    {
        self::assertInstanceOf(PostCommentRepository::class, $this->repository);
    }

    public function testRepositoryCanFindPostByPostCommentId()
    {
        /** @var Post */
        $post = $this->repository->find(1);

        self::assertEquals(1, $post->getId());
    }

    public function testRepositoryCanFindCommentsByPostId()
    {
        $posts = $this->repository->findBy(['post' => 1234]);

        self::assertCount(1, $posts);
    }
}
