<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = new User();
        $admin->setPseudo("pjehan");
        $admin->setEmail("pierre.jehan@gmail.com");
        $admin->setPassword($this->encoder->encodePassword($admin, "pjehan"));
        $admin->setRoles(["ROLE_ADMIN"]); //si pas admin, pas besoin de le mettre par defaut ROLE_USER
        $manager->persist($admin);
        $this->addReference("user-pjehan", $admin);

        $user = new User();
        $user->setPseudo("jdupont");
        $user->setEmail("jdupont@hotmail.com");
        $user->setPassword($this->encoder->encodePassword($user, "jdupont"));
        $manager->persist($user);
        $this->addReference("user-jdupont", $user);


        $manager->flush();
    }
}
