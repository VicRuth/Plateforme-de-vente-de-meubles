<?php

namespace App\Entity; // Définit l’espace de noms pour organiser les entités de l'application.

use App\Repository\CategoryRepository; // Permet de lier l’entité à son repository pour les interactions avec la base de données.
use Doctrine\ORM\Mapping as ORM; // Importe les annotations pour le mapping des entités avec Doctrine ORM.

#[ORM\Entity(repositoryClass: CategoryRepository::class)] // Indique que cette classe est une entité et spécifie son repository. # Déclare des méta données sur une classe ou une méthode

// Classe générée par création de l'entité via commande php bin/console make:entity
class Category
{ 
    #[ORM\Id] // Définit la propriété `$id` comme la clé primaire de l'entité.
    #[ORM\GeneratedValue] // Indique que la valeur de `$id` est générée automatiquement (auto-incrémentée).
    #[ORM\Column] // Définit `$id` comme une colonne dans la base de données.
    private ?int $id = null; // Propriété `id` de type entier, initialisée à `null`.

    #[ORM\Column(length: 255)] // Déclare une colonne `name` avec une longueur maximale de 255 caractères.
    private ?string $name = null; // Propriété `name` de type string, initialisée à `null`.

    // Méthode pour obtenir l'identifiant de la catégorie.
    public function getId(): ?int
    {
        return $this->id; // Retourne l'instance actuelle pour permettre le chaînage des appels de méthodes.
    }

    // Méthode pour obtenir le nom de la catégorie.
    public function getName(): ?string
    {
        return $this->name;
    }

    // Méthode pour définir le nom de la catégorie.
    public function setName(string $name): static
    {
        $this->name = $name;
        
        return $this; 
    }
}
