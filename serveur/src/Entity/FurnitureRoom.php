<?php

namespace App\Entity;

use App\Repository\FurnitureRoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FurnitureRoomRepository::class)]
class FurnitureRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Furniture::class)]
    #[ORM\JoinColumn(name: "furniture_id", referencedColumnName: "id", nullable: false)]
    private ?Furniture $furniture = null;

    #[ORM\ManyToOne(targetEntity: Room::class)]
    #[ORM\JoinColumn(name: "room_id", referencedColumnName: "id", nullable: false)]
    private ?Room $room = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }
}
