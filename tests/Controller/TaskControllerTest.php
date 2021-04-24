<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testCreateTask()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form(array(
            'task[title]' => 'TestAuto title',
            'task[content]' => 'TestAuto content',
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertStringContainsString('TestAuto', $client->getResponse()->getContent());
        $this->assertStringContainsString('La tâche a été bien été ajoutée.', $client->getResponse()->getContent());
    }

    public function testEditTask()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));
        $crawler = $client->request('GET', '/tasks/1/edit');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString('Modifier', $client->getResponse()->getContent());

        $form = $crawler->selectButton('Modifier')->form(array(
            'task[title]' => 'TestAuto ModifTitle',
            'task[content]' => 'TestAuto content',
        ));

        $crawler = $client->submit($form);

        $client->followRedirect();
        $this->assertStringContainsString('TestAuto ModifTitle', $client->getResponse()->getContent());
        $this->assertStringContainsString('La tâche a bien été modifiée.', $client->getResponse()->getContent());
    }

    public function testToggleTask()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        $crawler = $client->request('GET', '/tasks');

        $form = $crawler
            ->selectButton('Marquer comme faite')
            ->eq(1)
            ->form()
        ;

        $crawler = $client->submit($form);

        $client->followRedirect();
        $this->assertStringContainsString('a bien été marquée comme faite', $client->getResponse()->getContent());
    }

    public function testDeleteTask()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        $crawler = $client->request('GET', '/tasks');

        $form = $crawler
            ->selectButton('Supprimer')
            ->eq(2)
            ->form()
        ;

        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirection());


        $client->followRedirect();
        $this->assertStringContainsString('supprimée', $client->getResponse()->getContent());

        //TODO Tester 'lien Task - User
    }
}
