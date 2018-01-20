<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UsersFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {

        // Creates admin user
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPlainPassword('admin');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setEnabled(true);

        // Creates visitor
        $visitor = new User();
        $visitor->setUsername('visitor');
        $visitor->setPlainPassword('visitor');
        $visitor->setEmail('visitor@example.com');
        $visitor->setRoles(['ROLE_VISITOR']);
        $visitor->setEnabled(true);

        $manager->persist($admin);
        $manager->persist($visitor);

        $this->addReference('user-admin', $admin);
        $this->addReference('user-regular', $visitor);

        $manager->flush();

    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5;
    }
}