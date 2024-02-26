<?php namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource (normalizationContext:['groups'=>['products:read']])]

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['products:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['products:read'])]

    private ?string $product_name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['products:read'])]

    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: OrderProduct::class)]
    private Collection $orderProducts;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

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
            $orderProduct->setProducts($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): static
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getProducts() === $this) {
                $orderProduct->setProducts(null);
            }
        }

        return $this;
    }
} 

// // src/Entity/Product.php

// namespace App\Entity;

// use ApiPlatform\Metadata\ApiResource;
// use App\Repository\ProductRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;
// use App\Serializer\ProductNormalizer;

// #[ORM\Entity(repositoryClass: ProductRepository::class)]
// #[ApiResource(normalizationContext: ['groups' => ['product:read']], denormalizationContext: ['groups' => ['product:write']])]
// class Product
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 255)]
//     private ?string $product_name = null;

//     #[ORM\Column(nullable: true)]
//     private ?float $price = null;

//     #[ORM\ManyToOne(inversedBy: 'products')]
//     private ?Category $category = null;

//     #[ORM\OneToMany(mappedBy: 'products', targetEntity: OrderProduct::class)]
//     private Collection $orderProducts;

//     public function __construct()
//     {
//         $this->orderProducts = new ArrayCollection();
//     }

//     // ... autres propriétés et méthodes ...

//     /**
//      * @return array<int, array<string, mixed>>
//      */
//     public function getOrderProductsDetails(): array
//     {
//         $orderProductsDetails = [];

//         foreach ($this->orderProducts as $orderProduct) {
//             $orderProductsDetails[] = [
//                 '@id' => '/api/order_products/' . $orderProduct->getId(),
//                 '@type' => 'OrderProduct',
//                 'id' => $orderProduct->getId(),
//                 'quantity' => $orderProduct->getQuantity(),
//                 // Ajoutez d'autres propriétés d'OrderProduct nécessaires
//             ];
//         }

//         return $orderProductsDetails;
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getProductName(): ?string
//     {
//         return $this->product_name;
//     }

//     public function setProductName(string $product_name): static
//     {
//         $this->product_name = $product_name;

//         return $this;
//     }

//     public function getPrice(): ?float
//     {
//         return $this->price;
//     }

//     public function setPrice(?float $price): static
//     {
//         $this->price = $price;

//         return $this;
//     }

//     public function getCategory(): ?Category
//     {
//         return $this->category;
//     }

//     public function setCategory(?Category $category): static
//     {
//         $this->category = $category;

//         return $this;
//     }

//     /**
//      * @return Collection<int, OrderProduct>
//      */
//     public function getOrderProducts(): Collection
//     {
//         return $this->orderProducts;
//     }

//     public function addOrderProduct(OrderProduct $orderProduct): static
//     {
//         if (!$this->orderProducts->contains($orderProduct)) {
//             $this->orderProducts->add($orderProduct);
//             $orderProduct->setProducts($this);
//         }

//         return $this;
//     }

//     public function removeOrderProduct(OrderProduct $orderProduct): static
//     {
//         if ($this->orderProducts->removeElement($orderProduct)) {
//             // set the owning side to null (unless already changed)
//             if ($orderProduct->getProducts() === $this) {
//                 $orderProduct->setProducts(null);
//             }
//         }

//         return $this;
//     }
// }
