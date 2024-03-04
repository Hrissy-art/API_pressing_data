<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
#[ApiResource(normalizationContext:['groups'=>['orderProduct:read']])]

class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orderProduct:read'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]

    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    private ?Product $products = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    private ?Order $orders = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orderProduct:read'])]

    private ?Material $materials = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orderProduct:read'])]

    private ?QualityProduct $products_qualities = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orderProduct:read'])]


    private ?StatusOrder $statuses_orders = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['orderProduct:read'])]

    private ?Service $services = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): static
    {
        $this->products = $products;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getMaterials(): ?Material
    {
        return $this->materials;
    }

    public function setMaterials(?Material $materials): static
    {
        $this->materials = $materials;

        return $this;
    }

    public function getProductsQualities(): ?QualityProduct
    {
        return $this->products_qualities;
    }

    public function setProductsQualities(?QualityProduct $products_qualities): static
    {
        $this->products_qualities = $products_qualities;

        return $this;
    }

    public function getStatusesOrders(): ?StatusOrder
    {
        return $this->statuses_orders;
    }

    public function setStatusesOrders(?StatusOrder $statuses_orders): static
    {
        $this->statuses_orders = $statuses_orders;

        return $this;
    }

    public function getServices(): ?Service
    {
        return $this->services;
    }

    public function setServices(?Service $services): static
    {
        $this->services = $services;

        return $this;
    }
}
