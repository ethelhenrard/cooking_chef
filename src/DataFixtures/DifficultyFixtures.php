<?php

namespace App\DataFixtures;

use App\Entity\Difficulty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DifficultyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $difficulties = ["Facile", "Moyen", "Difficile"];

        //attention bien mettre $diff sinon ecrase $difficulty
        foreach ($difficulties as $difficulty){
            $diff = new Difficulty();
            $diff->setLabel($difficulty);
            $manager->persist($diff);
            $this->addReference("diff-" . strtolower($difficulty), $diff);
        }

        $manager->flush();
    }
}
