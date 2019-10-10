<?php

namespace App\Helper;

use Github\Client;
use App\Converter\MergeCommitConverter;
use Doctrine\ORM\EntityManager;

class githubHelper
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function callGithub() : Array
    {
        $githubClient = new Client();
        $converter = new MergeCommitConverter($this->em);
        return $converter->getDataFromGithub($githubClient->api('repo')->commits()->all('Prestashop', 'Prestashop', array('sha' => 'master')));
    }
}