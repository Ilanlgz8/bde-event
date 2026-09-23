<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MembreBDE extends User
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $role = null; // ex: "Président", "Trésorier"...

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;
        return $this;
    }
}