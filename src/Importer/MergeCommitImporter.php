<?php

namespace App\Importer;

use App\Helper\GithubHelper;
use App\Converter\MergeCommitConverter;
use Doctrine\ORM\EntityManagerInterface;

class MergeCommitImporter
{
    /**
     * @var MergeCommitConverter
     */
    private $converter;

    /**
     * @var EntityManagerInterface
     */
    private $entity;

    /**
     * @var githubHelper
     */
    private $githubHelper;

    /**
     * MergeCommitImporter constructor.
     * @param MergeCommitConverter $merge
     * @param EntityManagerInterface $entity
     * @param githubHelper $githubHelper
     */
    public function __construct(
        MergeCommitConverter $merge, 
        EntityManagerInterface $entity, 
        GithubHelper $githubHelper
    ){
        $this->converter = $merge;
        $this->entity = $entity;
        $this->githubHelper = $githubHelper;
    }

    /**
     * @return array
     */
    public function importAllPullRequest(): array
    {
        $githubResponse = $this->githubHelper->getAllPullRequests();

        foreach ($githubResponse as $key) {
            $mergeCommit = $this->converter->convert($key);
            $this->entity->persist($mergeCommit);
        }

        $this->entity->flush();

        return [
            'status' => 'success',
            'code' => 200,
        ];
    }
}
