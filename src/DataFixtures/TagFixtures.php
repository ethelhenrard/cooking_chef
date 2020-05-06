<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        //associatif pour pas avoir accent et s'en servir de clé
        $tags = [
            "vegetarien" => "Végétarien",
            "sans-glucose" => "Sans glucose",
            "fruits" => "Fruits",
            "legumes" => "Légumes",
            "poisson" => "Poisson"
        ];

        foreach ($tags as $key => $tag){
            $t = new Tag();
            $t->setLabel($tag);
            $manager->persist($t);
            $this->addReference("tag-" . $key, $t);

        }
        $manager->flush();
    }

}
