<?php

namespace Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testCreateUser()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);

        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/users/create');

        $testUserRoles = $testUser->getRoles();
        $this->assertContains('ROLE_ADMIN', $testUserRoles, 'Le user connecté n\'est pas admin');

        $form = $crawler->selectButton('Ajouter')->form(array(
            'user[username]' => 'JohnDoe',
            'user[password][first]' => 'passpass',
            'user[password][second]' => 'passpass',
            'user[email]' => 'johndoe@example.fr',
            'user[roles]' => 'ROLE_USER'
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('JohnDoe', $client->getResponse()->getContent());
        $this->assertStringContainsString('utilisateur a bien été ajouté', $client->getResponse()->getContent());
    }

    public function testEditUser()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);

        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/users/3/edit');

        $testUserRoles = $testUser->getRoles();
        $this->assertContains('ROLE_ADMIN', $testUserRoles, 'Le user connecté n\'est pas admin');

        $form = $crawler->selectButton('Modifier')->form(array(
            'user[username]' => 'JaneDoe',
            'user[password][first]' => 'passpass',
            'user[password][second]' => 'passpass',
            'user[email]' => 'janedoe@example.fr',
            'user[roles]' => 'ROLE_USER'
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();
        $this->assertStringContainsString('utilisateur a bien été modifié', $client->getResponse()->getContent());

        $crawler = $client->request('GET', '/users/3/edit');
        $this->assertStringContainsString('JaneDoe', $client->getResponse()->getContent());
    }
}
