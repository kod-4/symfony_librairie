<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarouselFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $carousel = new Carousel();
        $carousel->setNom("Robert Penn");
        $carousel->setTitre("Les Fous du Roi");
        $carousel->setContent("Donec sit amet nibh ac ligula venenatis dignissim. Donec tincidunt sem orci, consectetur malesuada sapien porttitor a. Vivamus suscipit ligula quis purus egestas facilisis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis non efficitur quam.");
        $carousel->setImage("slide-3-60a41df921d0b509665088.png");
        $carousel->setActive(1);
        $carousel->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setNom("Albert Camus");
        $carousel->setTitre("Faust");
        $carousel->setContent("Praesent quam urna, mollis id nunc quis, sagittis luctus nibh. Pellentesque ac felis sollicitudin.");
        $carousel->setImage("slide-1-60a41e07ecbe8600553168.png");
        $carousel->setActive(1);
        $carousel->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setNom("Bernard Meunier");
        $carousel->setTitre("Les possibles");
        $carousel->setContent("Nunc sit amet purus fermentum, fringilla quam vehicula, convallis tellus. Vestibulum nec est varius, bibendum turpis sit amet, condimentum turpis. Proin neque neque, tempus non augue euismod, consectetur semper leo.");
        $carousel->setImage("slide-4-60a41e2c1bb68154802823.png");
        $carousel->setActive(1);
        $carousel->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($carousel);


        $manager->flush();
    }
}
