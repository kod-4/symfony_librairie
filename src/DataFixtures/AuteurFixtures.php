<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuteurFixtures extends Fixture
{
    public const AUTEUR_CAMUS = "Albert Camus";
    public const AUTEUR_PENN = "Bob Penn";
    public function load(ObjectManager $manager)
    {
        $auteur = new Auteur();
        $auteur->setNom("Camus");
        $auteur->setPrenom("Albert");
        $auteur->setBiographie("Donec tincidunt sem orci, consectetur malesuada sapien porttitor a. Vivamus suscipit ligula quis purus egestas facilisis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis non efficitur quam, in volutpat nisi. Nulla sagittis arcu nisi, at sagittis ipsum finibus sed. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas sodales turpis felis, a pulvinar ipsum suscipit eget. Aenean lobortis scelerisque lorem vel varius. Vestibulum non orci at augue pulvinar sagittis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi nisi erat, bibendum at venenatis sit amet, fringilla quis mauris. Praesent at sodales urna. Cras maximus, orci vel commodo tincidunt, quam ligula ornare purus, vitae interdum augue risus eu augue. Ut quis magna vitae ligula sagittis elementum id sed nunc.");
        $auteur->setImage("auteur-60a6554a7641a590314970.jpg");
        $auteur->setActive(1);
        $auteur->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::AUTEUR_CAMUS, $auteur);
        
        $auteur = new Auteur();
        $auteur->setNom("Penn");
        $auteur->setPrenom("Bob");
        $auteur->setBiographie("Vivamus suscipit ligula quis purus egestas facilisis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis non efficitur quam, in volutpat nisi. Nulla sagittis arcu nisi, at sagittis ipsum finibus sed. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas sodales turpis felis, a pulvinar ipsum suscipit eget. Aenean lobortis scelerisque lorem vel varius. Vestibulum non orci at augue pulvinar sagittis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi nisi erat, bibendum at venenatis sit amet, fringilla quis mauris. Praesent at sodales urna. Cras maximus, orci vel commodo tincidunt, quam ligula ornare purus, vitae interdum augue risus eu augue. Ut quis magna vitae ligula sagittis elementum id sed nunc.");
        $auteur->setImage("auteur-1-60a653060b5b1530225167.jpg");
        $auteur->setActive(1);
        $auteur->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::AUTEUR_PENN, $auteur);

        $manager->flush();
    }
}
