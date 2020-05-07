<?php

namespace App\DataFixtures;

use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Recipe;

class StepFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $stepcookie1 = new Step();
        $stepcookie1->setRecipe($this->getReference("rec-cookie"));
        $stepcookie1->setNumber(1);
        $stepcookie1->setDescription("Mettre en morceau le chocolat");
        $manager->persist($stepcookie1);

        $stepcookie2 = new Step();
        $stepcookie2->setRecipe($this->getReference("rec-cookie"));
        $stepcookie2->setNumber(2);
        $stepcookie2->setDescription("Ajouter les oeufs et la farine. Mélangez");
        $manager->persist($stepcookie2);

        $stepcookie3 = new Step();
        $stepcookie3->setRecipe($this->getReference("rec-cookie"));
        $stepcookie3->setNumber(3);
        $stepcookie3->setDescription("Mettre au four à 180°");
        $manager->persist($stepcookie3);

        $i = 1;
        $salmon = [];

        $salmon[$i] = new Step();
        $salmon[$i]->setNumber($i);
        $salmon[$i]->setDescription("Mettre les pavés de saumon dans un plat allant au four.");
        $salmon[$i]->setRecipe($this->getReference("rec-saumon"));
        $manager->persist($salmon[$i]);

        ++$i;

        $salmon[$i] = new Step();
        $salmon[$i]->setNumber($i);
        $salmon[$i]->setDescription("Couper un citron en 2 et le presser sur les pavés. Couper le demi-citron restant en rondelles et les déposer directement sur le saumon.");
        $salmon[$i]->setRecipe($this->getReference("rec-saumon"));
        $manager->persist($salmon[$i]);

        ++$i;

        $salmon[$i] = new Step();
        $salmon[$i]->setNumber($i);
        $salmon[$i]->setDescription("Ciseler les petits oignons ainsi que le \"vert\" puis les mettre sur les pavés.");
        $salmon[$i]->setRecipe($this->getReference("rec-saumon"));
        $manager->persist($salmon[$i]);

        ++$i;

        $salmon[$i] = new Step();
        $salmon[$i]->setNumber($i);
        $salmon[$i]->setDescription("Ecraser les câpres et les poser sur le saumon (facultatif).");
        $salmon[$i]->setRecipe($this->getReference("rec-saumon"));
        $manager->persist($salmon[$i]);

        ++$i;

        $salmon[$i] = new Step();
        $salmon[$i]->setNumber($i);
        $salmon[$i]->setDescription("Verser le vin blanc et un filet d'huile d'olive sur les saumons, saler (très peu), poivrer et faire cuire à 180°, thermostat 6, pendant environ 25 min. */");
        $salmon[$i]->setRecipe($this->getReference("rec-saumon"));
        $manager->persist($salmon[$i]);

        $pancake = ["Melanger les oeufs avec la farine", "Ajouter les pepites de chocolat"];
        $i=1;


        $manager->flush();
    }

    public function getDependencies()
    {
        return [

            RecipeFixtures::class,

        ];
    }
}
