<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
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
     * @ORM\Column(name="MatriculeF", type="string", length=255, nullable=false)
     */
    private $matriculef;

    /**
     * @var string
     *
     * @ORM\Column(name="RaisonSociale", type="string", length=255, nullable=false)
     */
    private $raisonsociale;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=255, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="NoteGlobale", type="string", length=255, nullable=false)
     */
    private $noteglobale;

    /**
     * @var string
     *
     * @ORM\Column(name="RapportEcrit", type="text", length=65535, nullable=false)
     */
    private $rapportecrit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculef(): ?string
    {
        return $this->matriculef;
    }

    public function setMatriculef(string $matriculef): self
    {
        $this->matriculef = $matriculef;

        return $this;
    }

    public function getRaisonsociale(): ?string
    {
        return $this->raisonsociale;
    }

    public function setRaisonsociale(string $raisonsociale): self
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getNoteglobale(): ?string
    {
        return $this->noteglobale;
    }

    public function setNoteglobale(string $noteglobale): self
    {
        $this->noteglobale = $noteglobale;

        return $this;
    }

    public function getRapportecrit(): ?string
    {
        return $this->rapportecrit;
    }

    public function setRapportecrit(string $rapportecrit): self
    {
        $this->rapportecrit = $rapportecrit;

        return $this;
    }


}
