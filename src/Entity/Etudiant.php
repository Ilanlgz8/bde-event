<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Etudiant extends User
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $promotion = null;

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(?string $promotion): static
    {
        $this->promotion = $promotion;
        return $this;
    }
}