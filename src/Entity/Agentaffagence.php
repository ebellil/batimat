<?php

namespace App\Entity;

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
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

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

    public function getId(): ?Agent
    {
        return $this->id;
    }

    public function setId(?Agent $id): self
    {
        $this->id = $id;

        return $this;
    }


}
