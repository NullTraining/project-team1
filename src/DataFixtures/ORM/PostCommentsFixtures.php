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

        $declarationPostComment    = new PostComment(1234, 'I approve of this declaration!', $declarationPost, $regularUser);
        $businessReportPostComment = new PostComment(4321, 'I\m taking the biggest cut of profit for myself! HAHA! SO LONG, SUCKERS!!', $businessReportPost, $adminUser);

        $this->addReference('declarationPost-comment', $declarationPostComment);
        $this->addReference('businessReportPost-comment', $businessReportPostComment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}
