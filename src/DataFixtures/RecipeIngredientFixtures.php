<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\Ingredient;

class RecipeIngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $cookiesucre = new RecipeIngredient();
        $cookiesucre->setIngredient($this->getReference("ing-sucre"));
        $cookiesucre->setQuantity(120);
        $cookiesucre->setUnit($this->getReference("gr"));
        $cookiesucre->setRecipe($this->getReference("rec-cookie"));
        $manager->persist($cookiesucre);

        $cookiefarine = new RecipeIngredient();
        $cookiefarine->setIngredient($this->getReference("ing-farine"));
        $cookiefarine->setQuantity(120);
        $cookiefarine->setUnit($this->getReference("gr"));
        $cookiefarine->setRecipe($this->getReference("rec-cookie"));
        $manager->persist($cookiefarine);

        $cookieoeuf = new RecipeIngredient();
        $cookieoeuf->setIngredient($this->getReference("ing-oeufs"));
        $cookieoeuf->setQuantity( 2);
        $cookieoeuf->setUnit($this->getReference(""));
        $cookieoeuf->setRecipe($this->getReference("rec-cookie"));
        $manager->persist($cookieoeuf);

        $manager->flush();





    }

    public function getDependencies()
    {
        return [
            UnitFixtures::class,
            RecipeFixtures::class,
            IngredientFixtures::class
        ];
    }



}
