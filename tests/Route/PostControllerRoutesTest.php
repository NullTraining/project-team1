<?php

namespace App\Tests\Route;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerRoutesTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        yield ['/posts'];
        yield ['/posts/show/1'];
    }
}
