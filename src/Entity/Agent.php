<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Agent
 *
 * @ORM\Table(name="agent")
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 */
class Agent extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Admingeneachat", mappedBy="agent", cascade={"persist", "remove"})
     */
    private $admingeneachat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Agentaffagence", mappedBy="agent", cascade={"persist", "remove"})
     */
    private $agentaffagence;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="agent", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

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
    
    /**
     * @return string|null
     */
    public function getSalt(){
        return null;
    }

    /**
     * 
     */
    public function eraseCredentials(){
    }

    public function serialize(){
        return serialize([
            $this->id,
            $this->login,
            $this->mdp
        ]);
    }

    public function unserialize($serialized){
        list(
            $this->id,
            $this->login,
            $this->mdp
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getAdmingeneachat(): ?Admingeneachat
    {
        return $this->admingeneachat;
    }

    public function setAdmingeneachat(?Admingeneachat $admingeneachat): self
    {
        $this->admingeneachat = $admingeneachat;

        // set (or unset) the owning side of the relation if necessary
        $newAgent = $admingeneachat === null ? null : $this;
        if ($newAgent !== $admingeneachat->getAgent()) {
            $admingeneachat->setAgent($newAgent);
        }

        return $this;
    }

    public function getAgentaffagence(): ?Agentaffagence
    {
        return $this->agentaffagence;
    }

    public function setAgentaffagence(?Agentaffagence $agentaffagence): self
    {
        $this->agentaffagence = $agentaffagence;

        // set (or unset) the owning side of the relation if necessary
        $newAgent = $agentaffagence === null ? null : $this;
        if ($newAgent !== $agentaffagence->getAgent()) {
            $agentaffagence->setAgent($newAgent);
        }

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newAgent = $user === null ? null : $this;
        if ($newAgent !== $user->getAgent()) {
            $user->setAgent($newAgent);
        }

        return $this;
    }

}
