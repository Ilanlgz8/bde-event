<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MembreBDE extends User
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $role = null;

    /**
     * @var Collection<int, Evenements>
     */
    #[ORM\OneToMany(targetEntity: Evenements::class, mappedBy: 'membrebde')]
    private Collection $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    } // ex: "Président", "Trésorier"...

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection<int, Evenements>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenements $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setMembrebde($this);
        }

        return $this;
    }

    public function removeEvenement(Evenements $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getMembrebde() === $this) {
                $evenement->setMembrebde(null);
            }
        }

        return $this;
    }
}