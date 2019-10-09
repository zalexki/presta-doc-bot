<?php

namespace App\Converter;

use App\Entity\MergeCommit;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class MergeCommitConverter
{

    public function __construct()
    {
        
    }

    public function getDataFromGithub(array $data) : Array
    {
        $entityManager = $this->getDoctrine()->getManager();
        try {
            foreach ($responseGithub as $key => $value) {
                $merge = new MergeCommit();
                $user = new User();
                $user->setName($value['commit']['author']['name']);
                $user->setEmail($value['commit']['author']['email']);
                if (empty($value['author']['login'])) {
                    $user->setPseudo("undefined");
                } else {
                    $user->setPseudo($value['author']['login']);
                }
    
                if (empty($value['author']['login'])) {
                    $user->setAvatar('undefined');
                } else {
                    $user->setAvatar($value['author']['avatar_url']);
                }
    
                $merge->setUsers($user);
                $merge->setCommitMessage($value['commit']['message']);
                $merge->setIdMergeCommit($value['sha']);
                if (strstr($value['commit']['message'],'Merge pull request') === false) {
                    $merge->setIdPullRequest(0);
                } else {
                    preg_match_all('/\#\d+/m', $value['commit']['message'], $matches, PREG_SET_ORDER, 0);
                    foreach ($matches as $key) {
                        $idPull = substr($key[0],1,strlen($key[0]));
                        $merge->setIdPullRequest($idPull);
                    }
                }
                $entityManager->persist($merge);
            }
            $entityManager->flush();
            return ['status' => 200, 'message' => 'success'];
        } catch (\Throwable $th) {
            return ['status' => 400, 'message' => 'error'];
        }
    }
}