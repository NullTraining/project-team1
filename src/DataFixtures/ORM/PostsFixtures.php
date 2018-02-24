<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var User $ceo */
        $ceo = $this->getReference('user-admin');

        /** @var Category $declarations */
        $declarations    = $this->getReference('category-declarations');
        /** @var Category $businessReports */
        $businessReports = $this->getReference('category-business-reports');

        /** @var Post $declarationPost */
        $declarationPost = new Post();

        $declarationPost->setId(1234);
        $declarationPost->setTitle('We\'re starting a company');
        $declarationPost->setContent('Because we\'re cool!');
        $declarationPost->setCreatedAt(new \DateTime('now'));
        $declarationPost->setAuthor($ceo);
        $declarationPost->setCategory($declarations);

        /** @var Post $businessReportPost */
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
