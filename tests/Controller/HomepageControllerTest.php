<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $url = '/';

        $client = self::createClient();

        $client->request('GET', $url);

        $expectedToSee = 'Intranet';

        if (null !== ($client->getResponse())) {
            self::assertContains($expectedToSee, $client->getResponse()->getContent());
        }
    }
}
