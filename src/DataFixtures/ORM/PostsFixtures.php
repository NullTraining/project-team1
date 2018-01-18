<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $postOne = new Post(1234, 'Post One Title', 'Post One Content', new \DateTime('now'), 'Post One Author', 'Post One Category');

        $postTwo = new Post(4321, 'Post Two Title', 'Post Two Content', new \DateTime('now'), 'Post Two Author', 'Post Two Category');

        $manager->persist($postOne);
        $manager->persist($postTwo);

        $this->addReference('postOne', $postOne);
        $this->addReference('postTwo', $postTwo);

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
