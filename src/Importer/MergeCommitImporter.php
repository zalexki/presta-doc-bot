<?php

namespace App\Importer;

use App\Helper\GithubHelper;
use App\Converter\MergeCommitConverter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

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
    private $helper;

    /**
     * MergeCommitImporter constructor.
     * @param MergeCommitConverter $merge
     * @param EntityManagerInterface $entity
     * @param githubHelper $helper
     */
    public function __construct(MergeCommitConverter $merge, EntityManagerInterface $entity, GithubHelper $helper)
    {
        $this->converter = $merge;
        $this->entity = $entity;
        $this->helper = $helper;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function import(): array
    {
        $githubResponse = $this->helper->callGithub();

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
