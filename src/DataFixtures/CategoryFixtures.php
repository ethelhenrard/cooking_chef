<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $entree = new Category();
        $entree->setLabel("Entrée");
        $manager->persist($entree);
        //pour pouvoir reutiliser cet enregistrement ailleurs - dans une autre classe qui extend cette fixture
        $this->addReference("cat-entree", $entree);

        $plat = new Category();
        $plat->setLabel("Plat");
        $manager->persist($plat);
        $this->addReference("cat-plat", $plat);

        $dessert = new Category();
        $dessert->setLabel("Dessert");
        $manager->persist($dessert);
        $this->addReference("cat-dessert", $dessert);

        $manager->flush();
    }
}
