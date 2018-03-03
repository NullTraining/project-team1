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

        $redirectCodes = [301, 302];

        self::assertContains($client->getResponse()->getStatusCode(), $redirectCodes);
    }
}
