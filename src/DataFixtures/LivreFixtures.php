<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $livre = new Livre();
        $livre->setTitre("Fullmetal Alchemist");
        $livre->setDescription("Ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos.");
        $livre->setCategorie($this->getReference(CategorieFixtures::CATEGORRIE_MANGA_REFERENCE));
        $livre->setActive(1);
        $livre->setImage("manga-1-60a3b884d8bbd871373765.png");
        $livre->setConsult(1);
        $livre->setAuteur($this->getReference(AuteurFixtures::AUTEUR_PENN));
        $livre->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("À la recherche du temps perdu");
        $livre->setDescription("I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.");
        $livre->setCategorie($this->getReference(CategorieFixtures::CATEGORRIE_LITTERATURE_REFERENCE));
        $livre->setActive(1);
        $livre->setImage("livre-3-60a3b27bbb5c2140298400.png");
        $livre->setAuteur($this->getReference(AuteurFixtures::AUTEUR_CAMUS));
        $livre->setUpdatedAt(new \DateTimeImmutable());
        $livre->setConsult(1);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("La lignée de Loloth d'Otavia Becker");
        $livre->setDescription("On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will.");
        $livre->setCategorie($this->getReference(CategorieFixtures::CATEGORRIE_SCIENCE_REFERENCE));
        $livre->setActive(1);
        $livre->setImage("livre-8-60a3b2e26a234478203436.png");
        $livre->setAuteur($this->getReference(AuteurFixtures::AUTEUR_CAMUS));
        $livre->setUpdatedAt(new \DateTimeImmutable());
        $livre->setConsult(1);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("Histoire de la guerre du Péloponnèse");
        $livre->setDescription("In eu sagittis enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer congue interdum sollicitudin. Sed vel metus non elit rutrum mollis a ut leo.");
        $livre->setCategorie($this->getReference(CategorieFixtures::CATEGORRIE_HISTOIRE_REFERENCE));
        $livre->setActive(1);
        $livre->setImage("livre-5-60a3b2f2e5c17859633406.png");
        $livre->setAuteur($this->getReference(AuteurFixtures::AUTEUR_PENN));
        $livre->setUpdatedAt(new \DateTimeImmutable());
        $livre->setConsult(1);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre("Mon gros cahier pour apprenfre à lire et à écrire");
        $livre->setDescription("Vivamus imperdiet dictum sapien, eu mollis sem imperdiet id. Pellentesque pulvinar quis mauris vel maximus. Praesent interdum erat a ipsum interdum mattis.");
        $livre->setCategorie($this->getReference(CategorieFixtures::CATEGORRIE_LANGUE_REFERENCE));
        $livre->setActive(1);
        $livre->setImage("lng-60a3b379cda5e761446336.png");
        $livre->setAuteur($this->getReference(AuteurFixtures::AUTEUR_CAMUS));
        $livre->setUpdatedAt(new \DateTimeImmutable());
        $livre->setConsult(1);
        $manager->persist($livre);

        $manager->flush();
    }
}
