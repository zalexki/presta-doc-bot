<?php

namespace App\Converter;

use App\Entity\User;
use App\Entity\PullRequest;

class MergeCommitConverter
{
    /**
     * @param array $data
     *
     * @return PullRequest
     */
    public function convert(array $data): PullRequest
    {
        $merge = new PullRequest();
        $user = new User();
 
        $user->setName($data['user']['login']);
        $user->setAvatar($data['user']['avatar_url']);
        $merge->setUser($user);
        $merge->setState($data['state']);

        $merge->setTitle($data['title']);
        $merge->setBody($data['body']);
        $merge->setNumber($data['number']);
        $merge->setIdGithub($data['id']);
        $merge->setShaMergeCommit($data['merge_commit_sha']);
        $merge->setUrlPullRequest($data['html_url']);
        $merge->setPrCreatedAt(new \DateTime('@'.strtotime($data['created_at'])));
        $merge->setPrUpdatedAt(new \DateTime('@'.strtotime($data['updated_at'])));

        return $merge;
    }
}
