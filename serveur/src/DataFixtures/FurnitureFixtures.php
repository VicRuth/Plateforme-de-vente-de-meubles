<?php

namespace App\DataFixtures;

use App\Entity\Furniture;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FurnitureFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {


        // Spécifier le chemin du fichier JSON
        $file_path = __DIR__ . '/furnitures.json'; // Assurez-vous que le fichier JSON est dans le bon dossier

        // Lire le contenu du fichier JSON
        $json_data = file_get_contents($file_path);

        // Vérifier si le fichier a été correctement lu
        if ($json_data === false) {
            echo "Erreur lors de la lecture du fichier.";
            exit;
        }

        // Décoder le JSON en tableau PHP
        $data = json_decode($json_data, true);

        // Vérifier si le JSON a été correctement décodé
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erreur lors du décodage du JSON : " . json_last_error_msg();
            exit;
        }

        // Assurez-vous que la clé "furnitures" existe dans le JSON
        if (isset($data)) {
            // Insérer les meubles à partir des données du fichier JSON
            foreach ($data as $item) {
                var_dump($item);

                $furniture = new Furniture();
                $furniture->setTitle($item['Title'])
                    ->setDescription($item['Description'] ?? "Description par défaut") // Utilisez une valeur par défaut si la description est manquante
                    ->setPrice($item['Price'])
                    ->setState("Nouveau")
                    ->setStock((string) mt_rand(1, 50)) // Stock aléatoire
                    ->setColor($item['Color'] ?? "Couleur inconnue") // Valeur par défaut si la couleur est manquante
                    ->setMaterial($item['Material'] ?? "Matériau inconnu") // Valeur par défaut si le matériau est manquant
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setModifiedAt(new \DateTimeImmutable());

                // Ajouter 3 images associées à ce meuble
                for ($j = 1; $j <= 3; $j++) {
                    $image = new Image();
                    $image->setUrl($item['ImageURL']);
                    $image->setAlt('Image ' . $item['Title'] . ' pour Meuble ' . $item['Title']);
                    $image->setFurniture($furniture); // Lier l'image au meuble
                    $manager->persist($image); // Persister l'image
                }

                // Associe chaque meuble à une famille de manière aléatoire
                $familyReference = 'family_' . rand(0, 2);
                $furniture->setFamily($this->getReference($familyReference));

                // Persiste l'objet dans le gestionnaire
                $manager->persist($furniture);
            }
            $manager->flush();
        } else {
            echo "Aucune donnée de meubles trouvée dans le fichier JSON.";
            exit;
        }
    }
    public function getDependencies(): array
    {
        return [
            FamilyFixtures::class, // Dépendance à FamilyFixtures pour charger les familles en premier
        ];
    }
}
