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

        $expectedToSee = 'Redirecting';
        self::assertContains($expectedToSee, $client->getResponse()->getContent());
    }
}
