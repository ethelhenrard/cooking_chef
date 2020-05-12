<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $cookie = new Recipe();
        $cookie->setTitle("Cookies");
        $cookie->setBakingTime(new \DateTime("2020-01-01 00:09:00"));
        $cookie->setPreparationTime(new \DateTime("2020-01-01 00:15:00"));
        $cookie->setNbPersonne(4);
        $cookie->setPicture("cookies.jpg");
        $cookie->setCategory($this->getReference("cat-dessert"));
        $cookie->setDifficulty($this->getReference("diff-facile"));
        $cookie->addTag($this->getReference("tag-sans-glucose"));
        $cookie->addTag($this->getReference("tag-vegetarien"));
        $cookie->setUser($this->getReference("user-pjehan"));
        $manager->persist($cookie);
        $this->addReference("rec-cookie", $cookie);


        $pancake = new Recipe();
        $pancake->setTitle("Pancakes au chocolat");
        $pancake->setBakingTime(new \DateTime("2020-01-01 00:05:00"));
        $pancake->setPreparationTime(new \DateTime("2020-01-01 00:10:00"));
        $pancake->setNbPersonne(3);
        $pancake->setPicture("pancakes.jpg");
        $pancake->setCategory($this->getReference("cat-dessert"));
        $pancake->setDifficulty($this->getReference("diff-facile"));
        $pancake->setUser($this->getReference("user-jdupont"));
        $manager->persist($pancake);
        $this->addReference("rec-pancake", $pancake);

        $saumon = new Recipe();
        $saumon->setTitle("Saumon Teriaki");
        $saumon->setBakingTime(new \DateTime("2020-01-01 00:20:00"));
        $saumon->setPreparationTime(new \DateTime("2020-01-01 01:20:00"));
        $saumon->setNbPersonne(4);
        $saumon->setPicture("saumon.jpg");
        $saumon->setCategory($this->getReference("cat-plat"));
        $saumon->setDifficulty($this->getReference("diff-moyen"));
        $saumon->addTag($this->getReference("tag-poisson"));
        $saumon->addTag($this->getReference("tag-sans-glucose"));
        $saumon->setUser($this->getReference("user-jdupont"));
        $manager->persist($saumon);
        $this->addReference("rec-saumon", $saumon);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TagFixtures::class,
            CategoryFixtures::class,
            DifficultyFixtures::class,
            IngredientFixtures::class
        ];
    }
}
