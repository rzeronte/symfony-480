<?php

namespace App\Auth\Domain\Entity\User;

use App\Shared\ValueObject\UUID;
use Assert\AssertionFailedException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\UuidV4 as SymfonyUuid;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private UUID $id;

    private string $email;

    private string $password;

    /** @var array<string> */
    private array $roles = [];

    /**
     * @throws AssertionFailedException
     */
    public function __construct()
    {
        $this->id = UUID::from(SymfonyUuid::v4());
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array<string> $roles
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // Si tienes datos sensibles, límpialos aquí
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}
