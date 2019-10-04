<?php

namespace App\Controller;

use Github\Client;
use App\Entity\MergeCommit;
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
        dump($githubClient->api('repo')->commits()->all('Prestashop', 'Prestashop', array('sha' => 'master')));
        die;

        $entityManager = $this->getDoctrine()->getManager();
        $test = new MergeCommit();
        $test->setAuthorName('cc');
        $test->setCommitMessage('cc');
        $test->setIdMergeCommit(1);
        $test->setIdPullRequest(1);
        // $entityManager->persist($test);
        // $entityManager->flush();
        
        return $this->json([
            'message' => json_encode($test),
            'path' => 'src/Controller/HomepageController.php',
        ]);
    }
}
