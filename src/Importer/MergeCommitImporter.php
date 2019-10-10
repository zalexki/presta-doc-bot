<?php

namespace App\Importer;

use App\Helper\githubHelper;
use Doctrine\ORM\EntityManager;

class MergeCommitImporter
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function import()
    {
        $helper = new githubHelper($this->em);
        return $helper->callGithub();
    }
}