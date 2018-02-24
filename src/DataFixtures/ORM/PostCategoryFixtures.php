<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostCategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $declarations    = new Category();
        $declarations->setId(666);
        $declarations->setName('Declarations');

        $businessReports = new Category();
        $businessReports->setId(696);
        $businessReports->setName('Business Reports');

        $this->addReference('category-declarations', $declarations);
        $this->addReference('category-business-reports', $businessReports);

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
