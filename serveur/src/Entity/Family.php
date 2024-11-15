<?php

namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: FamilyRepository::class)] // Déclare une entité Doctrine pour représenter les familles de meubles
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('family:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('family:read')]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Family', targetEntity: Furniture::class)]
    private Collection $furniture;

    public function __construct()
    {
        $this->furniture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return Collection<int, Furniture>
     */
    #[Ignore]
    public function getFurniture(): Collection
    {
        return $this->furniture;
    }

    public function addFurniture(Furniture $furniture): static
    {
        if (!$this->furniture->contains($furniture)) {
            $this->furniture->add($furniture);
            $furniture->setFamily($this);
        }
        return $this;
    }

    public function removeFurniture(Furniture $furniture): static
    {
        if ($this->furniture->removeElement($furniture)) {
            if ($furniture->getFamily() === $this) {
                $furniture->setFamily(null);
            }
        }
        return $this;
    }
}
