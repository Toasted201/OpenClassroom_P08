<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($pageName, $url)
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'BobDoe',
            'PHP_AUTH_PW'   => 'passpass',
        ));

        //$client->catchExceptions(false);
        $client->request('GET', $url);
        $response = $client->getResponse();

        $this->assertTrue(
            $response->isSuccessful(),
            sprintf(
                'La page "%s" devrait être accessible, mais le code HTTP est "%s".',
                $pageName,
                $response->getStatusCode()
            )
        );
    }

    public function provideUrls()
    {
        return [
            'homepage' => ['homepage', '/'],
            'login' => ['login', '/login'],
            'task_list' => ['taskListe', '/tasks'],
            'task_create' => ['taskCreate', '/tasks/create'],
            'task' => ['task1', '/tasks/1/edit'],
            'user_list' => ['userListe', '/users'],
            'user_create' => ['userCreate', '/users/create'],
            'user' => ['user1', '/users/1/edit']
        ];
    }
}
