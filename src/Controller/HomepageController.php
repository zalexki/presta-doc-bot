<?php

namespace App\Controller;

use App\Importer\MergeCommitImporter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $importer = new MergeCommitImporter($this->getDoctrine()->getManager());
        return $this->json($importer->import());
    }
}
