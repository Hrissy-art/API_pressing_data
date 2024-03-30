<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
#[ApiResource(normalizationContext:['groups'=>['orderProduct:read']],denormalizationContext: ['groups' => ['orderProduct:write']])]


class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orderProduct:read', 'order:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[Groups(['orderProduct:read', 'orderProduct:write'])]


    private ?Product $products = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[Groups(['orderProduct:read', 'orderProduct:write'])]

    private ?Order $orders = null;

    #[ORM\ManyToMany(targetEntity: Material::class)]
    #[Groups(['orderProduct:read', 'orderProduct:write'])]
    private Collection $materials;

    #[ORM\ManyToMany(targetEntity: Service::class)]
    #[Groups(['orderProduct:read', 'orderProduct:write'])]
    private Collection $services;

    #[ORM\ManyToOne(inversedBy: 'payment')]
    private ?Payment $payment = null;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Material>
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): static
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
        }

        return $this;
    }

    public function removeMaterial(Material $material): static
    {
        $this->materials->removeElement($material);

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): static
    {
        $this->payment = $payment;

        return $this;
    }
}
// <?php

// namespace App\Entity;

// use ApiPlatform\Metadata\ApiResource;
// use App\Repository\OrderProductRepository;
// use Doctrine\DBAL\Types\Types;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Serializer\Annotation\Groups;

// #[ORM\Entity(repositoryClass: OrderProductRepository::class)]
// #[ApiResource(normalizationContext:['groups'=>['orderProduct:read']])]

// class OrderProduct
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     #[Groups(['orderProduct:read', 'order:read'])]
//     private ?int $id = null;

//     #[ORM\Column(type: Types::SMALLINT)]
//     // #[Groups(['orderProduct:read'])]
//     private ?int $quantity = null;

//     #[ORM\ManyToOne(inversedBy: 'orderProducts')]

//     private ?Product $products = null;

//     #[ORM\ManyToOne(inversedBy: 'orderProducts')]


//     private ?Order $orders = null;

//     #[ORM\ManyToMany(targetEntity: Material::class)]
//     #[Groups(['orderProduct:read'])]
//     private Collection $materials;

//     #[ORM\ManyToOne(inversedBy: 'orderProducts')]
//     #[ORM\JoinColumn(nullable: false)]
//     // #[Groups(['orderProduct:read'])]
//     private ?QualityProduct $products_qualities = null;

//     #[ORM\ManyToMany(targetEntity: Service::class)]
//     #[Groups(['orderProduct:read'])]
//     private Collection $services;

//     public function __construct()
//     {
//         $this->materials = new ArrayCollection();
//         $this->services = new ArrayCollection();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getQuantity(): ?int
//     {
//         return $this->quantity;
//     }

//     public function setQuantity(int $quantity): static
//     {
//         $this->quantity = $quantity;

//         return $this;
//     }

//     public function getProducts(): ?Product
//     {
//         return $this->products;
//     }

//     public function setProducts(?Product $products): static
//     {
//         $this->products = $products;

//         return $this;
//     }

//     public function getOrders(): ?Order
//     {
//         return $this->orders;
//     }

//     public function setOrders(?Order $orders): static
//     {
//         $this->orders = $orders;

//         return $this;
//     }

//     /**
//      * @return Collection<int, Material>
//      */
//     public function getMaterials(): Collection
//     {
//         return $this->materials;
//     }

//     public function addMaterial(Material $material): static
//     {
//         if (!$this->materials->contains($material)) {
//             $this->materials[] = $material;
//         }

//         return $this;
//     }

//     public function removeMaterial(Material $material): static
//     {
//         $this->materials->removeElement($material);

//         return $this;
//     }

//     public function getProductsQualities(): ?QualityProduct
//     {
//         return $this->products_qualities;
//     }

//     public function setProductsQualities(?QualityProduct $products_qualities): static
//     {
//         $this->products_qualities = $products_qualities;

//         return $this;
//     }

//     /**
//      * @return Collection<int, Service>
//      */
//     public function getServices(): Collection
//     {
//         return $this->services;
//     }

//     public function addService(Service $service): static
//     {
//         if (!$this->services->contains($service)) {
//             $this->services[] = $service;
//         }

//         return $this;
//     }

//     public function removeService(Service $service): static
//     {
//         $this->services->removeElement($service);

//         return $this;
//     }
// }