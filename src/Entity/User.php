<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 20, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 60, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $email;

    #[ORM\Column(type: 'string', length: 12, nullable: false)]
    private string $phone;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isEmailSubscribed = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isSmsSubscribed = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    public function getIsEmailSubscribed(): ?bool
    {
        return $this->isEmailSubscribed;
    }

    public function setIsEmailSubscribed(?bool $isEmailSubscribed): User
    {
        $this->isEmailSubscribed = $isEmailSubscribed;
        return $this;
    }

    public function getIsSmsSubscribed(): ?bool
    {
        return $this->isSmsSubscribed;
    }

    public function setIsSmsSubscribed(?bool $isSmsSubscribed): User
    {
        $this->isSmsSubscribed = $isSmsSubscribed;
        return $this;
    }

}
