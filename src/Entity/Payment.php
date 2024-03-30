<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ApiResource (normalizationContext:['groups'=>['payment:read']])]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['payment:read'])]

    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([ 'payment:read'])]

    private ?string $payment_method = null;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: OrderProduct::class)]
    private Collection $payment;

    public function __construct()
    {
        $this->payment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(?string $payment_method): static
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getPayment(): Collection
    {
        return $this->payment;
    }

    public function addPayment(OrderProduct $payment): static
    {
        if (!$this->payment->contains($payment)) {
            $this->payment->add($payment);
            $payment->setPayment($this);
        }

        return $this;
    }

    public function removePayment(OrderProduct $payment): static
    {
        if ($this->payment->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getPayment() === $this) {
                $payment->setPayment(null);
            }
        }

        return $this;
    }
}
