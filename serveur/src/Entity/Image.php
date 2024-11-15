<?php

namespace App\Entity;

use App\Repository\ImageRepository; // Repository associé à l'entité `Image`
use App\Entity\Furniture; // Relation avec l'entité `Furniture`
use Doctrine\ORM\Mapping as ORM; // Gestion des annotations pour Doctrine ORM
use Symfony\Component\Serializer\Annotation\Groups; // Gestion des groupes de sérialisation pour les réponses JSON

// Annotation qui déclare cette classe comme une entité gérée par Doctrine,
// en spécifiant le repository associé pour les opérations en base de données.
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('furniture:read')] 
    //Les annotations #[Groups('furniture:read')] permettent de contrôler quelles propriétés sont exposées dans les réponses API JSON.
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('furniture:read')]
    private ?string $url = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Groups('furniture:read')]
    private ?string $alt = null; 

    #[ORM\ManyToOne(inversedBy: 'images')] // Relation Many-to-One : une image est associée à un meuble spécifique.
    #[ORM\JoinColumn(nullable: false)]
    private ?Furniture $furniture = null;

    //Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getFurniture(): ?Furniture
    {
        return $this->furniture;
    }

    public function setFurniture(?Furniture $furniture): static
    {
        $this->furniture = $furniture;

        return $this;
    }
}
