<?php

namespace App\Importer;

use App\Entity\PullRequest;
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
        EntityManagerInterface $entityManager, 
        GithubHelper $githubHelper
    ){
        $this->converter = $merge;
        $this->entityManager = $entityManager;
        $this->githubHelper = $githubHelper;
    }

    /**
     * @return array
     */
    public function importAllPullRequest(): array
    {
        $githubResponse = $this->githubHelper->getAllPullRequests();
        $prRepository = $this->entityManager->getRepository(PullRequest::class);

        foreach ($githubResponse as $githubPullRequest) {
            $pullRequest = $prRepository->findOneBy(['idGithub' => $githubPullRequest['id']]);

            if ($pullRequest instanceof PullRequest) {
                $pullRequest = $this->converter->convert($githubPullRequest, $pullRequest);
            } else {
                $pullRequest = $this->converter->convert($githubPullRequest);
            }

            $this->entityManager->persist($pullRequest);
        }

        $this->entityManager->flush();

        return [
            'status' => 'success',
            'code' => 200,
        ];
    }
}
