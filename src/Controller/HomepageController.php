<?php

namespace App\Controller;

use App\Entity\MergeCommit;
use App\Importer\MergeCommitImporter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MergeCommitImporter $importer
     * @return Response
     */
    public function showPR(MergeCommitImporter $importer)
    {
        $commits = $this
                ->getDoctrine()
                ->getRepository(MergeCommit::class)
                ->findAll()
            ;

        return $this->render('base.html.twig', [
            'commits' => array_slice($commits, 0, 50),
        ]);
    }
}
