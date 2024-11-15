<?php

namespace App\DataFixtures; // Déclare l’espace de noms pour organiser les fixtures (données de test).

use App\Entity\Category; // Import de l’entité Category pour pouvoir créer des instances de cette entité.
use App\Entity\Furniture;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager; // Fournit les méthodes pour manipuler les objets dans la base de données.
use Doctrine\Bundle\FixturesBundle\Fixture; // Classe de base pour les fixtures, qui permet de charger des données de test.

class AppFixtures extends Fixture // Classe de fixture qui hérite de la classe Fixture de Doctrine.
{
    // Méthode `load` qui s’exécute pour charger les données en base de données.
    public function load(ObjectManager $manager): void
    {


        // Boucle pour créer et ajouter 10 catégories
        for ($i = 0; $i < 10; $i++) {
            $category = new Category(); // Création d’une nouvelle instance de Category.
            $category->setName('Category ' . $i); // Définit le nom de la catégorie (par exemple, "Category 0", "Category 1", etc.).
            $manager->persist($category); // Enregistre l'entité en attente d'insertion dans la base de données.
        }
        // Exécute les requêtes pour insérer toutes les entités en base de données.
        $manager->flush();
    }
}
