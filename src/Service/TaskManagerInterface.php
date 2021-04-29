<?php

namespace App\Service;

use App\Entity\Task;
use App\Entity\User;
use Exception;

interface TaskManagerInterface
{
    /**
     * Création d'une tâche
     * @throws Exception
     */
    public function createTask(Task $task, User $user): void;

    /**
     * Modification du statut terminée
     * @throws Exception
     */
    public function toggleTask(Task $task): void;
}
