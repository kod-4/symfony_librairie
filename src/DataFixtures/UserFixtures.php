<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    // ----- CONSTRUCTEUR ----- //
    // On fait une injection de dépendance dans le constructeur pour pouvoir
    // utiliser l'encoder de password de Symfony dans la fixture
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom("Marchand");
        $user->setPrenom("Igor");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setEmail("Marchand@mail.fr");
        $originePassword = "adminPass";
        $encodedPassword = $this->encoder->encodePassword($user, $originePassword);
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $user = new User();
        $user->setNom("Le Tonnelier");
        $user->setPrenom("Françoise");
        $user->setRoles(["ROLE_USER"]);
        $user->setEmail("Françoise@mail.com");
        $originePassword = "myPass";
        $encodedPassword = $this->encoder->encodePassword($user, $originePassword);
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
