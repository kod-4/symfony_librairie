<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{

    public const CATEGORRIE_MANGA_REFERENCE = "categorie_manga";
    public const CATEGORRIE_LITTERATURE_REFERENCE = "categorie_litterature";
    public const CATEGORRIE_SCIENCE_REFERENCE = "categorie_science";
    public const CATEGORRIE_HISTOIRE_REFERENCE = "categorie_histoire";
    public const CATEGORRIE_LANGUE_REFERENCE = "categorie_langue";

    public function load(ObjectManager $manager)
    {
        $categorie = new Categorie();
        $categorie->setTitre("Manga");
        $categorie->setDescription("On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will.");
        $categorie->setImage("manga-60a2d4ded5516733712760.png");
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $categorie->setActive(1);
        $manager->persist($categorie);
        $this->addReference(self::CATEGORRIE_MANGA_REFERENCE, $categorie);

        $categorie = new Categorie();
        $categorie->setTitre("Science Fiction");
        $categorie->setDescription("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.");
        $categorie->setImage("science-60a2d9c01a2ff946010936.png");
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $categorie->setActive(1);
        $manager->persist($categorie);
        $this->addReference(self::CATEGORRIE_SCIENCE_REFERENCE, $categorie);

        $categorie = new Categorie();
        $categorie->setTitre("Littérature");
        $categorie->setDescription(" But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures.");
        $categorie->setImage("litterature-60a2e0ff27660310615108.png");
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $categorie->setActive(1);
        $manager->persist($categorie);
        $this->addReference(self::CATEGORRIE_LITTERATURE_REFERENCE, $categorie);

        $categorie = new Categorie();
        $categorie->setTitre("Histoire");
        $categorie->setDescription("The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero.");
        $categorie->setImage("cat-2-60a2e145cfb38354557023.png");
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $categorie->setActive(1);
        $manager->persist($categorie);
        $this->addReference(self::CATEGORRIE_HISTOIRE_REFERENCE, $categorie);

        $categorie = new Categorie();
        $categorie->setTitre("Langues & Linguistique");
        $categorie->setDescription("Nulla odio sapien, rhoncus iaculis lorem sed, pellentesque sodales sapien. Integer et feugiat augue. Nullam imperdiet nisi eu massa ullamcorper sagittis. Fusce consequat tortor nunc, at finibus nisl pharetra nec. Phasellus eget luctus felis.");
        $categorie->setImage("langue-60a2e15d89fe7483369785.png");
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $categorie->setActive(1);
        $manager->persist($categorie);
        $this->addReference(self::CATEGORRIE_LANGUE_REFERENCE, $categorie);
        

        $manager->flush();
    }
}
