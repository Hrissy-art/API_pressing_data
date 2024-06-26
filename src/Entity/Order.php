<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource(normalizationContext:["groups"=>["order:read", 'order:write']])
]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orderproduct:read', "order:read"])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['orderproduct:read', "order:read"])]
    private ?\DateTimeInterface $dateOrder = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['orderproduct:read', "order:read"])]
    private ?\DateTimeInterface $dateRender = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrderProduct::class)]
    #[Groups(["order:read", 'orderproduct:read'])]
    private Collection $orderProducts;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orderproduct:read', "order:read", 'order:write'])]
    private ?Client $client = null;

    #[ORM\ManyToOne(targetEntity: StatusOrder::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read', 'orderproduct:read'])]
    private ?StatusOrder $statusOrder = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['order:read', 'order:write'])]
    private ?int $numberOrder = null;

    #[ORM\ManyToOne(inversedBy: 'employeeOrder')]
    #[Groups(['order:read', 'order:write'])]
    private ?Employee $employee = null;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->dateOrder;
    }

    public function setDateOrder(?\DateTimeInterface $dateOrder): static
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    public function getDateRender(): ?\DateTimeInterface
    {
        return $this->dateRender;
    }

    public function setDateRender(?\DateTimeInterface $dateRender): static
    {
        $this->dateRender = $dateRender;

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): static
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->add($orderProduct);
            $orderProduct->setOrders($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): static
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrders() === $this) {
                $orderProduct->setOrders(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getStatusOrder(): ?StatusOrder
    {
        return $this->statusOrder;
    }

    public function setStatusOrder(?StatusOrder $statusOrder): static
    {
        $this->statusOrder = $statusOrder;

        return $this;
    }

    public function getNumberOrder(): ?int
    {
        return $this->numberOrder;
    }

    public function setNumberOrder(?int $numberOrder): static
    {
        $this->numberOrder = $numberOrder;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    // public function __toString()
    // {
    //     return $this->get();
    // } 
}
