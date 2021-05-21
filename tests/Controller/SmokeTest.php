<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider provideUrlsAdmin
     */
    public function testPageIsSuccessful(string $pageName, string $url): void
    {
        $client = static::createClient();

        /** @var \App\Repository\UserRepository $userRepository*/
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'BobDoe']);

        if (!$testUser instanceof UserInterface) {
            throw new Exception("Il n'y a pas de testUser pour se connecter", 1);
        }
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
    public function testPageIsUnsuccessful(string $pageName, string $url): void
    {
        $client = static::createClient();

        /** @var \App\Repository\UserRepository $userRepository*/
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'DanyDoe']);

        if (!$testUser instanceof UserInterface) {
            throw new Exception("Il n'y a pas de testUser pour se connecter", 1);
        }
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

    /**
     * @return array<string, array<int, string>>
     */
    public function provideUrlsAdmin(): array
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

    /**
     * @return array<string, array<int, string>>
     */
    public function provideUrlsUser(): array
    {
        return [
            'user_list' => ['userListe', '/users'],
            'user_create' => ['userCreate', '/users/create'],
            'user' => ['user1', '/users/1/edit']
        ];
    }
}
