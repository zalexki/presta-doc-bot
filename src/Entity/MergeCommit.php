<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(type="integer")
     */
    private $idMergeCommit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorName;

    /**
     * @ORM\Column(type="text")
     */
    private $commitMessage;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPullRequest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMergeCommit(): ?int
    {
        return $this->idMergeCommit;
    }

    public function setIdMergeCommit(int $idMergeCommit): self
    {
        $this->idMergeCommit = $idMergeCommit;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;

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
}
