<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MergeCommitRepository")
 */
class MergeCommit
{
    use TimestampableEntity;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idMergeCommit;

    /**
     * @ORM\Column(type="text")
     */
    private $commitMessage;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPullRequest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mergeCommits",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMergeCommit(): ?string
    {
        return $this->idMergeCommit;
    }

    public function setIdMergeCommit(string $idMergeCommit): self
    {
        $this->idMergeCommit = $idMergeCommit;

        return $this;
    }

    public function getCommitMessage(): ?string
    {
        return $this->commitMessage;
    }

    public function setCommitMessage(string $commitMessage): self
    {
        $this->commitMessage = $commitMessage;

        return $this;
    }

    public function getIdPullRequest(): ?int
    {
        return $this->idPullRequest;
    }

    public function setIdPullRequest(int $idPullRequest): self
    {
        $this->idPullRequest = $idPullRequest;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    /**
     * @ManyToOne(..,cascade={"persist"})
     */
    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
