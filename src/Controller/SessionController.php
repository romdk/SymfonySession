<?php

namespace App\Controller;

use App\Entity\Session;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // récuperer les sessions de la bdd
        $today = date('d/m/Y');
        $sessions = $doctrine->getRepository(Session::class)->findBy([],['dateDebut' => 'ASC']);
        // $pastSessions = $doctrine->getRepository(Session::class)->findBy(['dateFin' < $today],['dateDebut' => 'ASC']);
        // $currentSessions = $doctrine->getRepository(Session::class)->findBy(['dateDebut' < $today && 'dateFin' > $today],['dateDebut' => 'ASC']);
        // $upcomingSessions = $doctrine->getRepository(Session::class)->findBy(['dateDebut' > $today],['dateDebut' => 'ASC']);
        return $this->render('session/index.html.twig', [
            'today' => $today,
            'sessions' => $sessions,
            // 'pastSessions' => $pastSessions,
            // 'currentSessions' => $currentSessions,
            // 'upcomingSessions' => $upcomingSessions,
        ]);
    }
}
