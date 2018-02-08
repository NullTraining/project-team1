<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostRepositoryTest extends KernelTestCase
{
    /** @var PostRepository */
    private $repository;

    public function setup()
    {
        $kernel = self::bootKernel();

        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $em->getRepository(Post::class);
    }

    public function testRepositoryCanBeCreated()
    {
        self::assertInstanceOf(PostRepository::class, $this->repository);
    }

    public function testRepositoryCanFindPostByPostId()
    {
        /** @var Post */
        $post = $this->repository->find(1234);

        self::assertEquals(1234, $post->getId());
    }

    public function testRepositoryCanFindPostsByPostCategoryId()
    {
        $posts = $this->repository->findBy(['category' => 1]);

        self::assertCount(1, $posts);
    }
}
