<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FurnitureRepository::class)] // Déclare une entité Doctrine pour représenter les meubles
class Furniture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('furniture:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('furniture:read')]
    private ?string $Title = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups('furniture:read')]
    private ?string $Description = null;

    #[ORM\Column]
    #[Groups('furniture:read')]
    private ?float $Price = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('furniture:read')]
    private ?string $State = null;

    #[ORM\Column(type: Types::BIGINT)]
    #[Groups('furniture:read')]
    private ?string $Stock = null;

    #[ORM\Column(length: 255)]
    #[Groups('furniture:read')]
    private ?string $Color = null;

    #[ORM\Column(length: 255)]
    #[Groups('furniture:read')]
    private ?string $Material = null;

    #[ORM\Column]
    #[Groups('furniture:read')]
    private ?\DateTimeImmutable $Created_At = null;

    #[ORM\Column]
    #[Groups('furniture:read')]
    private ?\DateTimeImmutable $Modified_At = null;

    #[ORM\ManyToOne(inversedBy: 'furniture')]
    private ?Family $Family = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'furniture', cascade: ['persist', 'remove'])]
    #[Groups('furniture:read')]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(?string $State): static
    {
        $this->State = $State;
        return $this;
    }

    public function getStock(): ?string
    {
        return $this->Stock;
    }

    public function setStock(string $Stock): static
    {
        $this->Stock = $Stock;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(string $Color): static
    {
        $this->Color = $Color;
        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->Material;
    }

    public function setMaterial(string $Material): static
    {
        $this->Material = $Material;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->Created_At;
    }

    public function setCreatedAt(\DateTimeImmutable $Created_At): static
    {
        $this->Created_At = $Created_At;
        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->Modified_At;
    }

    public function setModifiedAt(\DateTimeImmutable $Modified_At): static
    {
        $this->Modified_At = $Modified_At;
        return $this;
    }

    public function getFamily(): ?Family
    {
        return $this->Family;
    }

    public function setFamily(?Family $Family): void
    {
        $this->Family = $Family;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setFurniture($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getFurniture() === $this) {
                $image->setFurniture(null);
            }
        }
        return $this;
    }
}
