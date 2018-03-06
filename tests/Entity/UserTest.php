<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    /** @var User */
    private $adminUser;

    /** @var User */
    private $regularUser;

    /** @var UserRepository */
    private $repository;

    public function setup()
    {
        self::bootKernel();

        $this->repository = $this->getService(UserRepository::class);

        $this->adminUser = $this->repository->findOneBy(['username' => 'admin']);

        $this->regularUser = $this->repository->findOneBy(['username' => 'visitor']);
    }

    public function testUserHasPosts()
    {
        $posts = $this->adminUser->getPosts();

        self::assertNotEmpty($posts);
    }

    public function testUserHasComments()
    {
        $comments = $this->adminUser->getComments();

        self::assertNotEmpty($comments);
    }

    public function testUserCanBePromotedToAdmin()
    {
        $this->regularUser->promoteToAdministrator();
        self::assertTrue($this->regularUser->isAdministrator());
    }

    private function getService(string $serviceName)
    {
        return self::$kernel->getContainer()->get($serviceName);
    }
}
