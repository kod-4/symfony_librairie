<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 * @Vich\Uploadable
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="livres", fileNameProperty="image")
     * @Assert\Image(
     *     minWidth = 400,
     *     minWidthMessage = "Votre image est trop petite, la largeur minimum est de 400px",
     *     maxWidth = 600,
     *     maxWidthMessage = "Votre image est trop grande, la largeur maximum est de 600px",
     *     minHeight = 400,
     *     minHeightMessage = "Votre image est trop petite, la hauteur minimum est de 400px",
     *     maxHeight = 600,
     *     maxHeightMessage = "Votre image est trop grande, la hauteur maximum est de 600px"
     * )
     * 
     * @var File|null
     */
     private $imageFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;
    /**
     * @ORM\Column(type="datetime")
     */
     private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="livres")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="livres", cascade={"persist", "remove"})
     */
    private $auteur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $consult;

    /**
     * @ORM\OneToMany(targetEntity=Liste::class, mappedBy="livre")
     */
    private $listes;

    public function __construct()
    {
        $this->listes = new ArrayCollection();
    }
    public function __toString(){
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
     public function setImageFile(?File $imageFile = null): void
     {
         $this->imageFile = $imageFile;
 
         if (null !== $imageFile) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAt = new \DateTimeImmutable();
         }
     }
 
     public function getImageFile(): ?File
     {
         return $this->imageFile;
     }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        // Si le paramètre $updatedAt reçu est null on instancie une nouvelle date
        // que l'on affecte à la variable.
        if(is_null($updatedAt)) $updatedAt = new \DateTimeImmutable();
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getConsult(): ?bool
    {
        return $this->consult;
    }

    public function setConsult(?bool $consult): self
    {
        $this->consult = $consult;

        return $this;
    }

    /**
     * @return Collection|Liste[]
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Liste $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->setLivre($this);
        }

        return $this;
    }

    public function removeListe(Liste $liste): self
    {
        if ($this->listes->removeElement($liste)) {
            // set the owning side to null (unless already changed)
            if ($liste->getLivre() === $this) {
                $liste->setLivre(null);
            }
        }

        return $this;
    }
}
