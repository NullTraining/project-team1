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
        $ceo = $this->getReference('user-admin');

        $declarations    = $this->getReference('category-declarations');
        $businessReports = $this->getReference('category-business-reports');

        $declarationPost = new Post();

        $declarationPost->setId(1234);
        $declarationPost->setTitle('We\'re starting a company');
        $declarationPost->setContent('Because we\'re cool!');
        $declarationPost->setCreatedAt(new \DateTime('now'));
        $declarationPost->setAuthor($ceo);
        $declarationPost->setCategory($declarations);

        $businessReportPost = new Post();

        $businessReportPost->setId(4321);
        $businessReportPost->setTitle('We\'re rich!');
        $businessReportPost->setContent('Because we have a clearly superior product, ...');
        $businessReportPost->setCreatedAt(new \DateTime('now'));
        $businessReportPost->setAuthor($ceo);
        $businessReportPost->setCategory($businessReports);

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
