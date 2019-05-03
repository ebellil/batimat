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
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="idMat", columns={"idMat"}), @ORM\Index(name="idAgentAff", columns={"idAgentAff"})})
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
     * @ORM\OneToMany(targetEntity="Detaildemande", mappedBy="emande", cascade={"persist"})
     */
    protected $detaildemandes;


    /**
     * @var int
     *
     * @ORM\Column(name="idAgentAff", type="integer", nullable=false)
     */
    private $idagentaff;




    public function __construct()
    {    
        $temp = new \DateTime(); 
        $this->date = $temp;
        $this->etat=0;
        $this->detaildemandes = new \Doctrine\Common\Collections\ArrayCollection();
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

    /*
    public function addDetaildemandes(Detaildemande $detaildemande): self
    {
        if (!$this->detaildemandes->contains($detaildemande)) {
            $this->detaildemandes[] = $detaildemande;
        }
        return $this;
    }
*/
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
}
