<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 */
class PullRequest
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
    private $idGithub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shaMergeCommit;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mergeCommits", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $prCreatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $prUpdatedAt;

     /**
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @ORM\Column(type="text")
     */
    private $urlPullRequest;

    /**
     * Get the value of id
     * 
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of title
     * 
     * @return string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of idGithub
     */ 
    public function getIdGithub()
    {
        return $this->idGithub;
    }

    /**
     * Set the value of idGithub
     *
     * @return  self
     */ 
    public function setIdGithub($idGithub)
    {
        $this->idGithub = $idGithub;

        return $this;
    }

    /**
     * Get the value of shaMergeCommit
     */ 
    public function getShaMergeCommit()
    {
        return $this->shaMergeCommit;
    }

    /**
     * Set the value of shaMergeCommit
     *
     * @return  self
     */ 
    public function setShaMergeCommit($shaMergeCommit)
    {
        $this->shaMergeCommit = $shaMergeCommit;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of prCreatedAt
     */ 
    public function getPrCreatedAt()
    {
        return $this->prCreatedAt;
    }

    /**
     * Set the value of prCreatedAt
     *
     * @return  self
     */ 
    public function setPrCreatedAt($prCreatedAt)
    {
        $this->prCreatedAt = $prCreatedAt;

        return $this;
    }

    /**
     * Get the value of prUpdatedAt
     */ 
    public function getPrUpdatedAt()
    {
        return $this->prUpdatedAt;
    }

    /**
     * Set the value of prUpdatedAt
     *
     * @return  self
     */ 
    public function setPrUpdatedAt($prUpdatedAt)
    {
        $this->prUpdatedAt = $prUpdatedAt;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of urlPullRequest
     */ 
    public function getUrlPullRequest()
    {
        return $this->urlPullRequest;
    }

    /**
     * Set the value of urlPullRequest
     *
     * @return  self
     */ 
    public function setUrlPullRequest($urlPullRequest)
    {
        $this->urlPullRequest = $urlPullRequest;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }
}
