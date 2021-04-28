<?php

namespace Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogout()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Se déconnecter')->link();
        $client->click($link);

        $client->followRedirect();
        $client->followRedirect();

        $this->assertStringContainsString('Se connecter', $client->getResponse()->getContent());
    }

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form(array(
            'username' => 'BobDoe',
            'password' => 'passpass',
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('Se déconnecter', $client->getResponse()->getContent());
    }
}
