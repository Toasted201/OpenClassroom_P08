<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testCreateUser()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form(array(
            'user[username]' => 'JohnDoe',
            'user[password][first]' => 'passpass',
            'user[password][second]' => 'passpass',
            'user[email]' => 'johndoe@example.fr'
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('JohnDoe', $client->getResponse()->getContent());
        $this->assertStringContainsString('a bien été ajouté.', $client->getResponse()->getContent());
    }

    public function testEditUser()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        $crawler = $client->request('GET', '/users/2/edit');

        $form = $crawler->selectButton('Modifier')->form(array(
            'user[username]' => 'JaneDoe',
            'user[password][first]' => 'passpass',
            'user[password][second]' => 'passpass',
            'user[email]' => 'janedoe@example.fr'
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('a bien', $client->getResponse()->getContent());
    }
}
