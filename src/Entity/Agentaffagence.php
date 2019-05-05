<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agentaffagence
 *
 * @ORM\Table(name="agentaffagence")
 * @ORM\Entity(repositoryClass="App\Repository\AgentaffagenceRepository")
 */
class Agentaffagence
{
    /**
     * @var string
     *
     * @ORM\Column(name="MatriculeAg", type="string", length=255, nullable=false)
     */
    private $matriculeag;

    /**
     * @var string
     *
     * @ORM\Column(name="Agence", type="string", length=255, nullable=false)
     */
    private $agence;

    /**
     * @var string
     *
     * @ORM\Column(name="VilleAgence", type="string", length=255, nullable=false)
     */
    private $villeagence;

    /**
     * @var \Agent
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Agent", inversedBy="agentaffagence", cascade={"persist", "remove"})
     *@ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $agent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Demande", mappedBy="agent")
     */
    private $demandes;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getMatriculeag(): ?string
    {
        return $this->matriculeag;
    }

    public function setMatriculeag(string $matriculeag): self
    {
        $this->matriculeag = $matriculeag;

        return $this;
    }

    public function getAgence(): ?string
    {
        return $this->agence;
    }

    public function setAgence(string $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getVilleagence(): ?string
    {
        return $this->villeagence;
    }

    public function setVilleagence(string $villeagence): self
    {
        $this->villeagence = $villeagence;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(?Agent $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setAgent($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getAgent() === $this) {
                $demande->setAgent(null);
            }
        }

        return $this;
    }
/*
    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }
*/

}
