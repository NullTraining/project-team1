<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\PostComment;
use App\Repository\PostCommentRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostCommentRepositoryTest extends KernelTestCase
{
    /** @var PostCommentRepository */
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

    public function testRepositoryCanFindPostCommentById()
    {
        /** @var PostComment */
        $postComment = $this->repository->find(1);

        self::assertEquals(1, $postComment->getId());
    }

    public function testRepositoryCanFindPostCommentsByPostId()
    {
        $postsComments = $this->repository->findBy(['post' => 1234]);

        self::assertCount(1, $postsComments);
    }
}
