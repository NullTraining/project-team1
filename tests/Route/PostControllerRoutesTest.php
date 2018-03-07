<?php

namespace App\Tests\Route;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PostControllerRoutesTest extends WebTestCase
{
    private $repository;
    private $client;

    public function setUp()
    {
        $kernel = self::bootKernel();

        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $em->getRepository(User::class);

        $this->user   = $this->repository->find(1);
        $this->client = self::createClient();
    }

    /**
     * @dataProvider urlProvider
     */
    public function testLoggedInUserCanSeePage($url)
    {
        $this->logIn();
        $this->client->request('GET', $url);

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testAnonymousUserWillBeRedirected($url)
    {
        $this->client->request('GET', $url);

        $redirectCodes = [301, 302];

        $this->assertContains($this->client->getResponse()->getStatusCode(), $redirectCodes);
    }

    public function urlProvider()
    {
        yield ['/posts'];
        yield ['/posts/show/1'];
    }

    private function logIn()
    {
        $session         = $this->client->getContainer()->get('session');
        $firewallContext = 'main';

        $token = new UsernamePasswordToken($this->user, null, $firewallContext, ['ROLE_USER']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
