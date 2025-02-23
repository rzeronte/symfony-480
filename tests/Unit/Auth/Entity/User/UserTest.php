<?php

namespace App\Tests\Unit\Auth\Entity\User;

use App\Auth\Domain\Entity\User\User;
use App\Shared\ValueObject\UUID;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntityConstraints(): void
    {
        $user = new User();
        $user->setPassword('password');
        $user->setEmail('email@email.com');
        $user->setRoles(['ROLE_USER']);

        $this->assertEquals('email@email.com', $user->getEmail());
        $this->assertInstanceOf(UUID::class, $user->getId(), 'El ID debe ser una instancia de Uuid');
        $this->assertEquals($user->getId()->value(), $user->getUserIdentifier(), 'El ID debe ser una instancia de Uuid');
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }

    protected function setUp(): void
    {
    }
}
