<?php
namespace App\Entity;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Materiel
 * @ORM\Table(name="materiel", indexes={@ORM\Index(name="materiel_ibfk_1", columns={"idCat"}), @ORM\Index(name="idF", columns={"idF"})})
 * @ORM\Entity(repositoryClass="App\Repository\MaterielRepository")
 */
class Materiel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=255, nullable=false)
     */

    private $libelle;
    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;
    /**
     * @var int
     *
     * @ORM\Column(name="Stock", type="integer", nullable=false)
     */

    private $stock;
  
     /**
      * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="materiel")
      * @ORM\JoinColumn(name="idCat", referencedColumnName="id", nullable=false)
      */
     private $categorie;

     /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="materiel")
      * @ORM\JoinColumn(name="idF", referencedColumnName="id", nullable=false)
      */
     private $fournisseur;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="materiel",cascade={"persist"}, orphanRemoval=true)
     * @Vich\UploadableField(mapping="materiel_image")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }
    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->libelle);
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getStock(): ?int
    {
        return $this->stock;
    }
    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }
   
   /**
    * @return  self
    */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    public function getImageF()
    {
        return $this->images->first() ;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getAttachPictures()
    {
        return null;
    }

    public function setAttachPictures(array $files=array())
    {
        if (!$files) return [];
        foreach ($files as $file) {
            if (!$file) return [];
            $this->attachPicture($file);
        }
        return [];
    }

    public function attachPicture(UploadedFile $file=null) { 
        if (!$file) { 
            return; 
        } 
        $image = new Image();
        $image->setImageFile($file);
        $this->addImage($image); 
    }
    

    public function addImage(Image $image)
    {
      
            $image->setMateriel($this);
            dump($image);
            $this->images->add($image);
       

     
    }

    public function removeImage(Image $image)
    {
        $image->setMateriel(null);
       $this->images->removeElement($image);
    }

   
}