<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // récuperer les formations de la bdd
        $formations = $doctrine->getRepository(Formation::class)->findAll();
        return $this->render('formation/index.html.twig', [
            'formations' => $formations
        ]);
    }

    #[Route('/formation/{id}', name: 'detail_formation')]
    public function detail(Formation $formation, ManagerRegistry $doctrine): Response
    {   
        $today = date('d/m/Y');
        $sessions = $doctrine->getRepository(Session::class)->findBy([],['dateDebut' => 'ASC']);
        // $pastSessions = $doctrine->getRepository(Session::class)->findBy(['formationId' == '{id}' && 'dateFin' < $today],['dateDebut' => 'ASC']);
        // $currentSessions = $doctrine->getRepository(Session::class)->findBy(['formationId' == '{id}' && 'dateDebut' < $today && 'dateFin' > $today],['dateDebut' => 'ASC']);
        // $upcomingSessions = $doctrine->getRepository(Session::class)->findBy(['formationId' == '{id}' && 'dateDebut' > $today],['dateDebut' => 'ASC']);
        return $this->render('formation/detail.html.twig', [
            'formation' => $formation,
            'today' => $today,
            'sessions' => $sessions,
            // 'pastSessions' => $pastSessions,
            // 'currentSessions' => $currentSessions,
            // 'upcomingSessions' => $upcomingSessions,
        ]);
    }

}
