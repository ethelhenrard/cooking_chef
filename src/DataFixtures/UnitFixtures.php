<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UnitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $units = [
            "l" => "Litres",
            "gr" => "Grammes",
            "kg" => "Kilogrammes",
            "" => ""
         ];

        foreach ($units as $key => $unit) {
            $u = new Unit();
            $u->setLabel($unit);
            $manager->persist($u);
            $this->addReference($key, $u);

            $manager->flush();
        }
    }
}