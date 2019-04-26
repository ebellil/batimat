<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Materiel;
use App\Entity\Detaildemande;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="idMat", columns={"idMat"}), @ORM\Index(name="idAgentAff", columns={"idAgentAff"})})
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="NumCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numcommande;

    /**
     * @var string
     *
     * @ORM\Column(name="DemandeEcrite", type="string", length=255, nullable=false)
     */
    private $demandeecrite;



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
     * @var int
     *
     * @ORM\Column(name="idMat", type="integer", nullable=false)
     */
    private $idmat;

    /**
     * @var ArrayCollection
     * @ORM\OneToOne(targetEntity="App\Entity\Detaildemande", mappedBy="demande")
     * @ORM\JoinColumn(name="numcommande", referencedColumnName="numcommande")
     */
    private $detaildemandes;

    /**
     * @var int
     *
     * @ORM\Column(name="idAgentAff", type="integer", nullable=false)
     */
    private $idagentaff;

    /**
     * @var int
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;


    public function __construct()
    {    
        $this->date = new \DateTime(); 
        $this->etat=0;
        $this->materiels = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getNumcommande(): ?int
    {
        return $this->numcommande;
    }

    public function getDemandeecrite(): ?string
    {
        return $this->demandeecrite;
    }

    public function setDemandeecrite(string $demandeecrite): self
    {
        $this->demandeecrite = $demandeecrite;

        return $this;
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

    public function getIdmat(): ?int
    {
        return $this->idmat;
    }

    public function setIdmat(int $idmat): self
    {
        $this->idmat = $idmat;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection|Detaildemande[]
     */
    public function getDetaildemandes(): Collection
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


}
