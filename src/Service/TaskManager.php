<?php

namespace App\Service;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TaskManager implements TaskManagerInterface
{
    private EntityManagerInterface $entityManager;
    private TokenStorageInterface $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function createTask(Task $task): void
    {
        $token = $this->tokenStorage->getToken();
        if (!$token instanceof TokenStorageInterface) {
            throw new Exception();
        }
        $user = $token->getUser();
        if (!$user instanceof User) {
            throw new Exception();
        }
        $task->setUser($user);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function toggleTask(Task $task): void
    {
        $task->toggle(!$task->isDone());

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
