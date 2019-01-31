<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detaildemande
 *
 * @ORM\Table(name="detaildemande", indexes={@ORM\Index(name="numCommande", columns={"numCommande"})})
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
     * @var int
     *
     * @ORM\Column(name="numCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numcommande;

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

    public function getNumcommande(): ?int
    {
        return $this->numcommande;
    }


}
