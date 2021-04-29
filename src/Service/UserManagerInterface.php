<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Form\Form;

interface UserManagerInterface
{
    /**
     * Traitement du formulaire de création ou modification d'un User
     * @throws Exception
     */
    public function userForm(Form $form, User $user): void;
}
