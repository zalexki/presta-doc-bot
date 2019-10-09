<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MergeCommit", mappedBy="users")
     */
    private $mergeCommits;

    public function __construct()
    {
        $this->mergeCommits = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|MergeCommit[]
     */
    public function getMergeCommits(): Collection
    {
        return $this->mergeCommits;
    }

    public function addMergeCommit(MergeCommit $mergeCommit): self
    {
        if (!$this->mergeCommits->contains($mergeCommit)) {
            $this->mergeCommits[] = $mergeCommit;
            $mergeCommit->setUsers($this);
        }

        return $this;
    }

    public function removeMergeCommit(MergeCommit $mergeCommit): self
    {
        if ($this->mergeCommits->contains($mergeCommit)) {
            $this->mergeCommits->removeElement($mergeCommit);
            // set the owning side to null (unless already changed)
            if ($mergeCommit->getUsers() === $this) {
                $mergeCommit->setUsers(null);
            }
        }

        return $this;
    }
}
