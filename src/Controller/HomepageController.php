<?php

namespace App\Controller;

use App\Entity\PullRequest;
use App\Importer\MergeCommitImporter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function showPR()
    {
        $commits = $this
            ->getDoctrine()
            ->getRepository(PullRequest::class)
            ->findAll();

        return $this->render('homepage.html.twig', [
            'commits' => array_slice($commits, 0, 50),
        ]);
    }

    /**
     * @Route("/debug", name="debug")
     *
     * @return Response
     */
    public function debug(MergeCommitImporter $importer)
    {
        $importer->importAllPullRequest();
        
        $commits = $this
            ->getDoctrine()
            ->getRepository(MergeCommit::class)
            ->findAll();

        return $this->render('homepage.html.twig', [
            'commits' => array_slice($commits, 0, 50),
        ]);
    }
}
