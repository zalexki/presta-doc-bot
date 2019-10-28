<?php

namespace App\Controller;

use App\Entity\MergeCommit;
use App\Importer\MergeCommitImporter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MergeCommitRepository;

class HomepageController extends AbstractController
{
    /**
     * @Route("/show", name="index")
     */
    public function showPR(MergeCommitImporter $importer)
    {
        $commits = $this
                ->getDoctrine()
                ->getRepository(MergeCommit::class)
                ->findAll()
            ;

        return $this->render('base.html.twig', [
            'commits' => array_slice($commits,0,50)
        ]);
    }
}
