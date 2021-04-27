<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('BobDoe');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'passpass'));
        $user->setEmail('bobdoe@example.fr');
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $manager->flush();


        $date = new DateTime();

        for ($i = 0; $i < 5; $i++) {
            $taskTest = new Task();
            $taskTest->setTitle('Titre ' . $i);
            $taskTest->setContent('Content' . $i);
            $taskTest->setCreatedAt($date);
            $taskTest->setUser($user);
            $manager->persist($taskTest);
        }
        $manager->flush();

        $taskTestAno = new Task();
        $taskTestAno->setTitle('Tache sans User');
        $taskTestAno->setContent('Content');
        $taskTestAno->setCreatedAt($date);
        $manager->persist($taskTestAno);
        $manager->flush();
    }
}
