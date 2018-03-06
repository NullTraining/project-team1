<?php

namespace App\Tests\Route;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerRoutesTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        if (null !== ($client->getResponse())) {
            $this->assertTrue($client->getResponse()->isSuccessful());
        }
    }

    public function urlProvider()
    {
        yield ['/'];
    }
}
