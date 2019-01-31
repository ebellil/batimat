<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    private $date;

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
     * @var int
     *
     * @ORM\Column(name="idAgentAff", type="integer", nullable=false)
     */
    private $idagentaff;

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


}
