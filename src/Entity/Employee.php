<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ApiResource (normalizationContext:['groups'=>['employees:read']])]

class Employee extends User
{

    #[ORM\Column(length: 255)]
    #[Groups(['employees:read'])]
    private ?string $empNumber = null;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Order::class)]
    private Collection $employeeOrder;

    public function __construct()
    {
        $this->employeeOrder = new ArrayCollection();
    }

    
    public function getEmpNumber(): ?string
    {
        return $this->empNumber;
    }

    public function setEmpNumber(string $empNumber): static
    {
        $this->empNumber = $empNumber;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getEmployeeOrder(): Collection
    {
        return $this->employeeOrder;
    }

    public function addEmployeeOrder(Order $employeeOrder): static
    {
        if (!$this->employeeOrder->contains($employeeOrder)) {
            $this->employeeOrder->add($employeeOrder);
            $employeeOrder->setEmployee($this);
        }

        return $this;
    }

    public function removeEmployeeOrder(Order $employeeOrder): static
    {
        if ($this->employeeOrder->removeElement($employeeOrder)) {
            // set the owning side to null (unless already changed)
            if ($employeeOrder->getEmployee() === $this) {
                $employeeOrder->setEmployee(null);
            }
        }

        return $this;
    }

}
