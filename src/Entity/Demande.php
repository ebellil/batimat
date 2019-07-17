<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Materiel;
use App\Entity\Detaildemande;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use \DateTime;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="idMat", columns={"idMat"}), @ORM\Index(name="idagentaff", columns={"idagentaff"})})
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="numcommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numcommande ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date ;

    /**
     * @var bool
     *
     * @ORM\Column(name="Etat", type="boolean", nullable=false)
     */
    private $etat;


    /**
     * @ORM\OneToMany(targetEntity="Detaildemande", mappedBy="demande", cascade={"persist"})
     */
    protected $detaildemandes;

    
    /*
     * @var int
     * @ORM\Column(name="idagentaff", type="integer", nullable=false)
     */
    protected $idagentaff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="demandes")
     * @ORM\JoinColumn(name="idMat", referencedColumnName="id", nullable=false)
     */
    private $materiel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agentaffagence", inversedBy="demandes")
     * @ORM\JoinColumn(name="idagentaff", referencedColumnName="id", nullable=false)
     */
    private $agent;


    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $idmat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rapport;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    public function __construct()
    {    
        $temp = new \DateTime(); 
        $this->date = $temp;
        $this->etat=0;
        $this->detaildemandes = new \Doctrine\Common\Collections\ArrayCollection();
       // $this->idagentaf = 55;
    }


    public function getNumcommande(): ?int
    {
        return $this->numcommande;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getIdagentaff(): ?int
    {
        return $this->idagentaff;
    }

    public function setIdagentaff(int $idagentaff): self
    {
        $this->idagentaff = $idagentaff;

        return $this;
    }

    /**
     * @return Collection|Detaildemande[]
     */
    public function getDetaildemandes(): Collection
    {
        return $this->detaildemandes;
    }

        /**
     * @return Collection|Detaildemande[]
     */
    public function getDetaildemande(): Collection
    {
        return $this->detaildemandes;
    }

    public function addDetaildemande(Detaildemande $detaildemande): self
    {
        if (!$this->detaildemandes->contains($detaildemande)) {
            $this->detaildemandes[] = $detaildemande;
        }
        return $this;
    }

    public function removeDetaildemande(Detaildemande $detaildemande): self
    {
        if (!$this->detaildemandes->contains($detaildemande)) {
            $this->detaildemandes->removeElement($detaildemande);
        }
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function setDetaildemandes($detaildemandes)
    {
        $this->detaildemandes = $detaildemandes;
    }

    public function __toString() {
        return ' ';
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getAgent(): ?Agentaffagence
    {
        return $this->agent;
    }

    public function setAgent(?Agentaffagence $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdmat(): ?int
    {
        return $this->idmat;
    }

    public function setIdmat(int $idmat): self
    {
        $this->idmat = $idmat;

        return $this;
    }

    public function getRapport(): ?string
    {
        return $this->rapport;
    }

    public function setRapport(?string $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }
}
