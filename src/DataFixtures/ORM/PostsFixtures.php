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
        $declarations    = $this->getReference('category-declarations');
        $businessReports = $this->getReference('category-business-reports');

        $declarationPost = new Post(1234, 'We\'re starting a company', 'Because we\'re cool!', new \DateTime('now'), 'CEO To Be',
        $declarations);

        $businessReportPost = new Post(4321, 'We\'re rich!', 'Because we have a clearly superior product, ...', new \DateTime('now'), 'CEO', $businessReports);

        $manager->persist($declarationPost);
        $manager->persist($businessReportPost);

        $this->addReference('declarationPost', $declarationPost);
        $this->addReference('businessReportPost', $businessReportPost);

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}
