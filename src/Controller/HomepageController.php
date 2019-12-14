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
    public function indexAction()
    {
        $pullRequests = $this
            ->getDoctrine()
            ->getRepository(PullRequest::class)
            ->findBy(['state' => 'closed'], ['prCreatedAt' => 'DESC'], 30);

        return $this->render('homepage.html.twig', [
            'pullRequests' => $pullRequests,
        ]);
    }

    /**
     * @Route("/openedones", name="openedones")
     *
     * @return Response
     */
    public function openedOnesAction()
    {
        $pullRequests = $this
            ->getDoctrine()
            ->getRepository(PullRequest::class)
            ->findBy(['state' => 'open'], ['prCreatedAt' => 'DESC']);

        return $this->render('homepage.html.twig', [
            'pullRequests' => $pullRequests,
        ]);
    }
}
