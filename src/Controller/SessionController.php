<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine, SessionRepository $sr): Response
    {
        // récuperer les sessions de la bdd
        $today = date('d/m/Y');
        $pastSessions = $sr->findPastSessions();
        $currentSessions = $sr->findCurrentSessions();
        $upcomingSessions = $sr->findUpcomingSessions();
        return $this->render('session/index.html.twig', [
            'today' => $today,
            'pastSessions' => $pastSessions,
            'currentSessions' => $currentSessions,
            'upcomingSessions' => $upcomingSessions,
        ]);
    }
}
