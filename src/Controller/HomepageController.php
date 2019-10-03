<?php

namespace App\Controller;

use App\Entity\MergeCommit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $test = new MergeCommit();
        $test->setAuthorName('cc');
        $test->setCommitMessage('cc');
        $test->setIdMergeCommit(1);
        $test->setIdPullRequest(1);
        $entityManager->persist($test);
        $entityManager->flush();
        
        
        return $this->json([
            'message' => json_encode($test),
            'path' => 'src/Controller/HomepageController.php',
        ]);
    }
}
