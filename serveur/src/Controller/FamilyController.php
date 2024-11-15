<?php

namespace App\Controller; // Définit l’espace de noms pour organiser les classes.

use App\Repository\FamilyRepository; // Permet d’accéder aux méthodes de CategoryRepository pour interagir avec les données.
use Symfony\Component\HttpFoundation\Response; // Fournit des constantes pour les statuts HTTP, comme HTTP_OK.
use Symfony\Component\Routing\Attribute\Route; // Permet de définir les routes (URL) de l'application.
use Symfony\Component\HttpFoundation\JsonResponse; // Classe pour créer une réponse en JSON.
use Symfony\Component\Serializer\SerializerInterface; // Utilisée pour convertir les objets en JSON.
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour les contrôleurs Symfony.

class FamilyController extends AbstractController // Définition de la classe contrôleur.
{
    // Définit une route pour accéder à la liste des catégories via l'URL '/api/categories'
    #[Route('/api/family', name: 'app_category', methods: ['GET'])]
    public function getFamilyList(FamilyRepository $familyRepository, SerializerInterface $serializer): JsonResponse
    {
        // Récupère toutes les catégories depuis la base de données en utilisant le CategoryRepository
        $categoryList = $familyRepository->findAll();

        // Sérialise la liste des catégories en format JSON
        $jsonCategoryList = $serializer->serialize($categoryList, 'json');

        // Retourne la liste des catégories sous forme de réponse JSON avec un statut HTTP 200 (OK)
        return new JsonResponse($jsonCategoryList, Response::HTTP_OK, [], true);
        // Le quatrième paramètre `true` indique que les données sont déjà encodées en JSON et n’ont pas besoin de l’être à nouveau.
    }
}
