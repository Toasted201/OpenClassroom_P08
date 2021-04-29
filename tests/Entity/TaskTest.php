<?php

namespace Tests\Entity;

use App\Entity\Task;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskTest extends WebTestCase
{
    public function testCreatedAt()
    {
        $task = new Task();
        $newDate = new DateTime(date('2020-01-01 00:00:00'));
        $task->setCreatedAt($newDate);
        $this->assertEquals($newDate, $task->getCreatedAt());
    }

    public function testisDone()
    {
        $task = new Task();

        $task->setIsDone(false);
        $this->assertEquals(false, $task->getIsDone());
    }
}
