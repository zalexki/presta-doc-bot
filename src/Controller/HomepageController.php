<?php

namespace App\Controller;

use Github\Client;
use App\Entity\MergeCommit;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $githubClient = new Client();
        $responseGithub = $githubClient->api('repo')->commits()->all('Prestashop', 'Prestashop', array('sha' => 'master'));
        $entityManager = $this->getDoctrine()->getManager();

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
            $entityManager->flush();
        }
        
        return $this->json([
            'message' => 'success',
        ]);
    }
}
