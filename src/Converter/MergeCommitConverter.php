<?php

namespace App\Converter;

use App\Entity\User;
use App\Entity\MergeCommit;
use Doctrine\ORM\EntityManagerInterface;

class MergeCommitConverter
{

    public function convert(array $data) : MergeCommit
    {
        $merge = new MergeCommit();
        $user = new User();

        $user->setName($data['user']['login']);
        $user->setAvatar($data['user']['avatar_url']);
        $merge->setUsers($user);
        
        $merge->setCommitMessage($data['title']);
        $merge->setIdMergeCommit($data['id']);
        $merge->setIdPullRequest($data['number']);
        $merge->setUrlPullRequest($data['html_url']);
        $merge->setCommitedAt(new \DateTime('@'.strtotime($data['created_at'])));

        return $merge;
    }
}