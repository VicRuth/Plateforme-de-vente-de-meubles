<?php

namespace App\Controller;

use App\Repository\FurnitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class FurnitureController extends AbstractController
{
    // Définit une route pour accéder à l'ensemble des meubles  via l'URL 'furniture'
    #[Route('/api/furniture', name: 'app_furniture_index', methods: ['GET']) ]
    public function getProducts(FurnitureRepository $furnitureRepository, SerializerInterface $serializer): JsonResponse
    {
                // Récupération des données depuis la base de données
                $furnitures = $furnitureRepository->findAll();

                // retourne une erreur 404 en cas d'absence de meubles dans la BDD
                if (!$furnitures) {
                    return new JsonResponse(['error' => 'No furniture found'], 404);
                }

                // transformation des données en JSON
                // $data = $serializer->serialize($furnitures, 'json');
                $data = $serializer->serialize($furnitures, 'json', ['groups' => 'furniture:read']);
        
                // Retourne la réponse JSON
                return new JsonResponse($data, 200, [], true);
    }

    // #[Route('/api/furniture', name: 'api_furniture_index', methods: ['GET'])]
    // public function getAllFurniture(FurnitureRepository $furnitureRepository): JsonResponse
    // {
    //     // Récupère tous les meubles
    //     $furnitures = $furnitureRepository->findAll();

    //     // Récupère tous les meubles
    //     $furnitures = $furnitureRepository->findAll();

    //     // Transformation en tableau pour le format JSON, en incluant les informations de famille
    //     $data = array_map(fn($furniture) => [
    //         'id' => $furniture->getId(),
    //         'title' => $furniture->getTitle(),
    //         'description' => $furniture->getDescription(),
    //         'price' => $furniture->getPrice(),
    //         'state' => $furniture->getState(),
    //         'stock' => $furniture->getStock(),
    //         'color' => $furniture->getColor(),
    //         'material' => $furniture->getMaterial(),
    //         'created_at' => $furniture->getCreatedAt()->format('Y-m-d H:i:s'),
    //         'modified_at' => $furniture->getModifiedAt()->format('Y-m-d H:i:s'),
    //         'family' => $furniture->getFamily() ? [
    //             'id' => $furniture->getFamily()->getId(),
    //             'name' => $furniture->getFamily()->getName(),
    //         ] : null, // Inclut la famille si elle existe
    //     ], $furnitures);

    //     return new JsonResponse($data);
    // }
    
    // Définit une route pour accéder aux détails d'un meuble spécifique en fonction de son ID
     #[Route('/api/furniture/{id}', name: 'app_furniture_details', methods: ['GET'])]
     public function getProductDetails(int $id, FurnitureRepository $furnitureRepository, SerializerInterface $serializer): JsonResponse
     {
         // Récupérer un meuble par son ID
         $furniture = $furnitureRepository->find($id);
 
         if (!$furniture) {
             return new JsonResponse(['error' => 'Furniture not found'], 404);
         }
 
         // Sérialisation en JSON du meuble trouvé

         $data = $serializer->serialize($furniture, 'json', ['groups' => 'furniture:read']);
 
         // Retourner la réponse JSON avec les détails du meuble
         return new JsonResponse($data, 200, [], true);
     }

}

