<?php

namespace App\Service;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager implements TaskManagerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createTask(Task $task, User $user): void
    {
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
