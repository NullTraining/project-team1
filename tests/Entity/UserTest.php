<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    /** @var User */
    private $user;

    /** @var UserRepository */
    private $repository;

    public function setUp()
    {
        $kernel = self::bootKernel();

        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $em->getRepository(User::class);
    }

    public function testUserHasPosts()
    {
        $this->user = $this->repository->findOneBy(['username' => 'admin']);

        $posts = $this->user->getPosts();

        self::assertNotEmpty($posts);
    }

    public function testUserHasComments()
    {
        $this->user = $this->repository->findOneBy(['username' => 'admin']);

        $comments = $this->user->getComments();

        self::assertNotEmpty($comments);
    }

    public function testUserCanBePromotedToAdmin()
    {
        $this->user = $this->repository->findOneBy(['username' => 'user']);

        $this->user->promoteToAdministrator();
        self::assertTrue($this->user->isAdministrator());
    }
}
