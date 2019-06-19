<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actuality", mappedBy="categories")
     */
    private $actualities;

    public function __construct()
    {
        $this->actualities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Actuality[]
     */
    public function getActualities(): Collection
    {
        return $this->actualities;
    }

    public function addActuality(Actuality $actuality): self
    {
        if (!$this->actualities->contains($actuality)) {
            $this->actualities[] = $actuality;
        }

        return $this;
    }

    public function removeActuality(Actuality $actuality): self
    {
        if ($this->actualities->contains($actuality)) {
            $this->actualities->removeElement($actuality);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }
}
