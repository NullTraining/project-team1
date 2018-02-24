<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\PostComment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostCommentsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $declarationPost    = $this->getReference('declarationPost');
        $businessReportPost = $this->getReference('businessReportPost');

        $regularUser = $this->getReference('user-regular');
        $adminUser   = $this->getReference('user-admin');

        $declarationPostComment    = new PostComment();
        $declarationPostComment->setId(1234);
        $declarationPostComment->setComment('I approve of this declaration!');
        $declarationPostComment->setPost($declarationPost);
        $declarationPostComment->setUser($regularUser);

        $businessReportPostComment = new PostComment();

        $businessReportPostComment->setId(4321);
        $businessReportPostComment->setComment('I\'m taking the biggest cut of profit for myself! HAHA! SO LONG, SUCKERS!!');
        $businessReportPostComment->setPost($businessReportPost);
        $businessReportPostComment->setUser($adminUser);

        $manager->persist($declarationPostComment);
        $manager->persist($businessReportPostComment);

        $this->addReference('declarationPost-comment', $declarationPostComment);
        $this->addReference('businessReportPost-comment', $businessReportPostComment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}
