<?php

namespace App\DataFixtures;

use App\Entity\Family;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FamilyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $families = ['Chaises', 'Tables', 'Canapés'];

        foreach ($families as $key => $familyName) {
            $family = new Family();
            $family->setName($familyName);

            // Persist et référence chaque famille
            $manager->persist($family);
            $this->addReference('family_' . $key, $family);
        }

        $manager->flush();
    }
}
