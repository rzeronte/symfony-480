<?php

namespace App\DataFixtures;

use App\Auth\Domain\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class UserFixtures extends Fixture
{
    private UserPasswordHasher $passwordHasher;

    public function __construct(UserPasswordHasher $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['email' => 'johndoe@example.com', 'password' => 'SecurePassword123'],
            ['email' => 'edu@test.com', 'password' => '123456789'],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
