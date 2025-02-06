<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testClassConstructor()
    {
        $user = new User();

        $user
            ->setFirstName('Adam')
            ->setLastName('Adamiak')
            ->setEmail('adamiak@gmail.com')
            ->setPhone('123456789');

        $this->assertSame('Adam', $user->getFirstName());
        $this->assertSame('Adamiak', $user->getLastName());
        $this->assertSame('adamiak@gmail.com', $user->getEmail());
        $this->assertSame('123456789', $user->getPhone());
    }
}