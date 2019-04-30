<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Admingeneachat
 *
 * @ORM\Table(name="admingeneachat")
 * @ORM\Entity(repositoryClass="App\Repository\AdmingeneachatRepository")
 */
class Admingeneachat
{
     /**
     * @var \Agent
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="MatriculeAd", type="string", length=255, nullable=false)
     */
    private $matriculead;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Agent", inversedBy="admingeneachat", cascade={"persist", "remove"})
     */
    private $agent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="adminegeneral")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournisseurRapport", mappedBy="admingeneral")
     */
    private $fournisseurRapports;

   

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->fournisseurRapports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }


    public function getMatriculead(): ?string
    {
        return $this->matriculead;
    }

    public function setMatriculead(string $matriculead): self
    {
        $this->matriculead = $matriculead;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
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
            $note->setAdminegeneral($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getAdminegeneral() === $this) {
                $note->setAdminegeneral(null);
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
            $fournisseurRapport->setAdmingeneral($this);
        }

        return $this;
    }

    public function removeFournisseurRapport(FournisseurRapport $fournisseurRapport): self
    {
        if ($this->fournisseurRapports->contains($fournisseurRapport)) {
            $this->fournisseurRapports->removeElement($fournisseurRapport);
            // set the owning side to null (unless already changed)
            if ($fournisseurRapport->getAdmingeneral() === $this) {
                $fournisseurRapport->setAdmingeneral(null);
            }
        }

        return $this;
    }


}
