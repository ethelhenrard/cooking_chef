<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $ingredients = [
            "farine" => "Farine",
            "sucre" => "Sucre",
            "chocolat" => "Chocolat",
            "oeufs" => "Oeufs",
            "saumon" => "Saumon",
            "creme-fraiche" => "Crème fraîche",
            "ciboulette" => "Ciboulette"];

        foreach ($ingredients as $key => $ingredient){
            $ing = new Ingredient();
            $ing->setLabel($ingredient);
            $manager->persist($ing);
            $this->addReference("ing-" . $key, $ing);
        }

        $manager->flush();
    }
}
