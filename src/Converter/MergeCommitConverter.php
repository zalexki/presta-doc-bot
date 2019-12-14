<?php

namespace App\Converter;

use App\Entity\User;
use App\Entity\PullRequest;

class MergeCommitConverter
{
    /**
     * @param array $data
     * @param PullRequest|null $pullRequest
     *
     * @return PullRequest
     */
    public function convert(array $data, PullRequest $pullRequest = null): PullRequest
    {
        if ($pullRequest === null) {
            $pullRequest = new PullRequest();
            $user = new User();
        } else {
            $user = $pullRequest->getUser();
        }
        
        $user->setName($data['user']['login']);
        $user->setAvatar($data['user']['avatar_url']);
        $pullRequest->setUser($user);
        $pullRequest->setState($data['state']);

        $pullRequest->setTitle($data['title']);
        $pullRequest->setBody($data['body']);
        $pullRequest->setNumber($data['number']);
        $pullRequest->setIdGithub($data['id']);
        $pullRequest->setShaMergeCommit($data['merge_commit_sha']);
        $pullRequest->setUrlPullRequest($data['html_url']);
        $pullRequest->setPrCreatedAt(new \DateTime('@'.strtotime($data['created_at'])));
        $pullRequest->setPrUpdatedAt(new \DateTime('@'.strtotime($data['updated_at'])));

        return $pullRequest;
    }
}
