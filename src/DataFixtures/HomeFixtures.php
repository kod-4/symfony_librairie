<?php

namespace App\DataFixtures;

use App\Entity\Home;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HomeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $home = new Home();
        $home->setTitre("Welcome !");
        $home->setDescription("At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa.");
        $home->setSignature("Librairie Team");
        $home->setActive(1);
        $manager->persist($home);

        $manager->flush();
    }
}
