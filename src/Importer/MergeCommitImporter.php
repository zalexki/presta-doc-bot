<?php

namespace App\Importer;

use App\Helper\githubHelper;
use App\Converter\MergeCommitConverter;
use Doctrine\ORM\EntityManagerInterface;

class MergeCommitImporter
{
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function import()
    {
        $helper = new githubHelper();
        $converter = new MergeCommitConverter($this->em);
        $githubResponse = $helper->callGithub();
        return $converter->convert($githubResponse);
    }
}