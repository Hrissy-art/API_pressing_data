<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(normalizationContext:['groups'=>['users:read']])]

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(['user' => User::class, 'client' => Client::class, 'employee'=> Employee::class, 'admin' => Admin::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups (['users:read', 'clients:read', 'order:read','employees:read'])]
    protected ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['users:read', 'cleints:read', 'order:read','employees:read'])]
    protected ?string $email = null;

    #[ORM\Column]
    #[Groups(['users:read'])]

    protected array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['users:read', 'employees:read'])]
    protected ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users:read', 'order:read', 'employees:read'])]
    protected ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users:read', 'order:read', 'employees:read'])]
    protected ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users:read','order:read', 'employees:read'])]
    protected ?string $adress = null;

    #[ORM\Column(type: "date")]
    #[Groups(['users:read', 'employees:read'])]
    protected ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users:read', 'order:read', 'employees:read'])]

    protected ?string $street_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users:read', 'order:read', 'employees:read'])]

    protected ?string $town = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users:read','order:read', 'employees:read'])]

    protected ?string $district = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users:read','order:read', 'employees:read'])]

    protected ?string $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->street_number;
    }

    public function setStreetNumber(?string $street_number): static
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }
}
