<?php

namespace App\Entity;

use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'districts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\OneToMany(mappedBy: 'district', targetEntity: Town::class)]
    private Collection $towns;

    public function __construct()
    {
        $this->towns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Town>
     */
    public function getTowns(): Collection
    {
        return $this->towns;
    }

    public function addTown(Town $town): static
    {
        if (!$this->towns->contains($town)) {
            $this->towns->add($town);
            $town->setDistrict($this);
        }

        return $this;
    }

    public function removeTown(Town $town): static
    {
        if ($this->towns->removeElement($town)) {
            // set the owning side to null (unless already changed)
            if ($town->getDistrict() === $this) {
                $town->setDistrict(null);
            }
        }

        return $this;
    }
}
