<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Materiel", mappedBy="fournisseur")
     */
    private $materiel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="fournisseur")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournisseurRapport", mappedBy="fournisseur")
     */
    private $fournisseurRapports;


    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->fournisseurRapports = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }


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

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel[] = $materiel;
            $materiel->setFournisseur($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiel->contains($materiel)) {
            $this->materiel->removeElement($materiel);
            // set the owning side to null (unless already changed)
            if ($materiel->getFournisseur() === $this) {
                $materiel->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setFournisseur($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getFournisseur() === $this) {
                $note->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FournisseurRapport[]
     */
    public function getFournisseurRapports(): Collection
    {
        return $this->fournisseurRapports;
    }

    public function addFournisseurRapport(FournisseurRapport $fournisseurRapport): self
    {
        if (!$this->fournisseurRapports->contains($fournisseurRapport)) {
            $this->fournisseurRapports[] = $fournisseurRapport;
            $fournisseurRapport->setFournisseur($this);
        }

        return $this;
    }

    public function removeFournisseurRapport(FournisseurRapport $fournisseurRapport): self
    {
        if ($this->fournisseurRapports->contains($fournisseurRapport)) {
            $this->fournisseurRapports->removeElement($fournisseurRapport);
            // set the owning side to null (unless already changed)
            if ($fournisseurRapport->getFournisseur() === $this) {
                $fournisseurRapport->setFournisseur(null);
            }
        }

        return $this;
    }


}
