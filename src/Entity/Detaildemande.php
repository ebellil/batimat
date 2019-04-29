<?php

namespace App\Entity;
use App\Entity\Demande;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Detaildemande
 *
 * @ORM\Table(name="detaildemande", indexes={@ORM\Index(name="numcommande", columns={"numcommande"})})
 * @ORM\Entity(repositoryClass="App\Repository\DetaildemandeRepository")
 */
class Detaildemande
{
    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="Note", type="float", precision=10, scale=0, nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="Commentaire", type="text", length=65535, nullable=false)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="idMat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idmat;

    /**
     *
     * @ORM\Column(name="numCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    //private $numcommande;


    /**
     * @ORM\ManyToOne(targetEntity="Demande", inversedBy="detaildemande")
     * @ORM\JoinColumn(name="numcommande_id", referencedColumnName="numcommande")
     */
    protected $demande;


    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    /**
     * Set demande
     *
     * @param \App\Entity\Demande $demande
     *
     * @return Detaildemande
     */
    public function setDemande(\App\Entity\Demande $demande = null)
    {
        $this->demande = $demande;
        return $this;
    }
    /**
     * Get demande
     *
     * @return \App\Entity\Demande
     */
    public function getDemande()
    {
        return $this->demande;
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

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getIdmat(): ?int
    {
        return $this->idmat;
    }

    public function setIdmat(int $idm): self
    {
        $this->idmat = $idm;

        return $this;
    }

    /*
    public function getNumcommande(): ?int
    {
        return $this->numcommande;
    }

    public function setNumcommande(int $nc): self
    {
        $this->numcommande = $nc;
        
        return $this;
    }
    */
}
