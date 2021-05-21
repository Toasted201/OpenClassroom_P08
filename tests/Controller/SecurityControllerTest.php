<?php

namespace Tests\Controller;

use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityControllerTest extends WebTestCase
{
    public function testLogout(): void
    {
        $client = static::createClient();

        /** @var \App\Repository\UserRepository $userRepository*/
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);

        if (!$testUser instanceof UserInterface) {
            throw new Exception("Il n'y a pas de testUser pour se connecter", 1);
        }
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Se déconnecter')->link();
        $client->click($link);

        $client->followRedirect();
        $client->followRedirect();

        $this->assertStringContainsString('Se connecter', '' . $client->getResponse()->getContent());
    }

    public function testLogin(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form(array(
            'username' => 'BobDoe',
            'password' => 'passpass',
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('Se déconnecter', '' . $client->getResponse()->getContent());
    }
}
