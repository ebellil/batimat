<?php
// EN ATTENTE
//PAS UTILE
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandematerielrapportRepository")
 */
class Demandematerielrapport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="Demandematerielrapports")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admingeneachat", inversedBy="Demandematerielrapports")
     */
    private $admingeneral;

   

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getAgentaff(): ?Admingeneachat
    {
        return $this->admingeneral;
    }

    public function setAgentaff(?Admingeneachat $admingeneral): self
    {
        $this->admingeneral = $admingeneral;

        return $this;
    }
}
