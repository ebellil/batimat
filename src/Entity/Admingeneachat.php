<?php

namespace App\Entity;

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
     * @ORM\Column(name="MatriculeAd", type="string", length=255, nullable=false)
     */
    private $matriculead;

    public function getId(): ?int
    {
        return $this->id;
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


}
