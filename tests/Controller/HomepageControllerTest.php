<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HomepageControllerTest extends WebTestCase
{

    public function testHomepage()
    {
        $url = '/';

        $client = self::createClient();

        $client->request('GET', $url);

        $greetMessage = 'Please <a href="/login">Log in</a> or <a href="/register/">Register</a>';
        self::assertContains($greetMessage, $client->getResponse()->getContent());
    }
}