<?php

namespace App\Converter;

use App\Entity\MergeCommit;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class MergeCommitConverter
{

    public function convert(array $data) : MergeCommit
    {
        $merge = new MergeCommit();
        $user = new User();
        $user->setName($data['commit']['author']['name']);
        $user->setEmail($data['commit']['author']['email']);
        if (empty($data['author']['login'])) {
            $user->setPseudo("undefined");
        } else {
            $user->setPseudo($data['author']['login']);
        }

        if (empty($data['author']['login'])) {
            $user->setAvatar('undefined');
        } else {
            $user->setAvatar($data['author']['avatar_url']);
        }

        $merge->setUsers($user);
        $merge->setCommitMessage($data['commit']['message']);
        $merge->setIdMergeCommit($data['sha']);
        if (strstr($data['commit']['message'],'Merge pull request') === false) {
            $merge->setIdPullRequest(0);
        } else {
            preg_match_all('/\#\d+/m', $data['commit']['message'], $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $key) {
                $idPull = substr($key[0],1,strlen($key[0]));
                $merge->setIdPullRequest((int)$idPull);
            }
        }

        return $merge;
    }
}