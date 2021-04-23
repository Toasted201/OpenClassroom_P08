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

        $manager->persist($user);
        $manager->flush();


        $date = new DateTime();

        for ($i = 0; $i < 5; $i++) {
            $taskTest = new Task();
            $taskTest->setTitle('Titre ' . $i);
            $taskTest->setContent('Content' . $i);
            $taskTest->setCreatedAt($date);
            $manager->persist($taskTest);
        }
        $manager->flush();
    }
}
