<?php

namespace App\Importer;

use App\Helper\githubHelper;
use App\Converter\MergeCommitConverter;
use Doctrine\ORM\EntityManagerInterface;

class MergeCommitImporter
{
    private $converter;
    private $entity;
    private $helper;

    public function __construct(MergeCommitConverter $merge, EntityManagerInterface $entity, githubHelper $helper)
    {
        $this->converter = $merge;
        $this->entity = $entity;
        $this->helper = $helper;
    }

    public function import() : Array
    {
        $githubResponse = $this->helper->callGithub();

        foreach($githubResponse as $key) {
            $mergeCommit = $this->converter->convert($key);
            $this->entity->persist($mergeCommit);
        }
        
        $this->entity->flush();

        return [
            'status' => 'success', 
            'code' => 200
        ];
    }
}
