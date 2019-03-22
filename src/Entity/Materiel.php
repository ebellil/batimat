<?php
namespace App\Entity;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Materiel
 *
 * @ORM\Table(name="materiel", indexes={@ORM\Index(name="materiel_ibfk_1", columns={"idCat"}), @ORM\Index(name="idF", columns={"idF"})})
 * @ORM\Entity(repositoryClass="App\Repository\MaterielRepository")
 * @Vich\Uploadable
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
     * @var int
     *
     * @ORM\Column(name="idCat", type="integer", nullable=false)
     */

    private $idcat;
    /**
    * @ORM\ManyToMany (targetEntity="Categorie")
    * @ORM\JoinColumn(name="idCat", referencedColumnName="id")
    private $categorie;*/
     /**
     * @var Categorie
    
     * @ORM\OneToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="idCat", referencedColumnName="id")
 
    private $categorie;    */
    /**
     * @var int
     *
     * @ORM\Column(name="idF", type="integer", nullable=false)
     */
    private $idf;
     /**
    * @ORM\ManyToOne (targetEntity="Fournisseur")
    * @ORM\JoinColumn(name="idF", referencedColumnName="id")
    
     private $fournisseur;
*/
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
     * @var string|null
     * @ORM\Column(name="fileName", type="string", length=255)
     */
    private $fileName;

    /**
     * @var File|null
     * @Assert\Image(
     *      mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="materiel_image", fileNameProperty="fileName")
     */
    private $imageFile;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     *
     */
    private $updated_at;

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
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Materiel
     */
    public function setImageFile(?File $imageFile): Materiel
    {
        $this->imageFile = $imageFile;
        if (null !== $this->imageFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param null|string $fileName
     * @return Materiel
     */
    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    


 
   /**
    * @return  self
   
   public function getFournisseur()
    {
        return $this->fournisseur;
    }
   public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;
        return $this;
    }
 */

    /*
     public function getIdcat(): ?int
    {
        return $this->idcat;
    }
    public function setIdcat(int $idcat): self
    {
        $this->idcat = $idcat;
        return $this;
    }

       public function getIdf(): ?int
    {
        return $this->idf;
    }
    public function setIdf(int $idf): self
    {
        $this->idf = $idf;
        return $this;
    }
    */
}