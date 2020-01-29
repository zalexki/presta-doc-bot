<?php

namespace App\Controller;

use App\Entity\PullRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
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
