<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider provideUrlsAdmin
     */
    public function testPageIsSuccessful($pageName, $url)
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);

        $client->loginUser($testUser);

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

    /**
     * @dataProvider provideUrlsUSer
     */
    public function testPageIsUnsuccessful($pageName, $url)
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'DanyDoe']);

        $client->loginUser($testUser);

        $client->request('GET', $url);
        $response = $client->getResponse();

        $this->assertTrue(
            $response->isForbidden(),
            sprintf(
                'La page "%s" devrait être inaccessible, mais le code HTTP est "%s".',
                $pageName,
                $response->getStatusCode()
            )
        );
    }

    public function provideUrlsAdmin()
    {
        return [
            'homepage' => ['homepage', '/'],
            'login' => ['login', '/login'],
            'task_list' => ['taskListe', '/tasks'],
            'task_list_done' => ['taskListeDone', '/tasks/done'],
            'task_list_todo' => ['taskListeTodo', '/tasks/todo'],
            'task_create' => ['taskCreate', '/tasks/create'],
            'task' => ['task1', '/tasks/1/edit'],
            'user_list' => ['userListe', '/users'],
            'user_create' => ['userCreate', '/users/create'],
            'user' => ['user1', '/users/1/edit']
        ];
    }

    public function provideUrlsUser()
    {
        return [
            'user_list' => ['userListe', '/users'],
            'user_create' => ['userCreate', '/users/create'],
            'user' => ['user1', '/users/1/edit']
        ];
    }
}
