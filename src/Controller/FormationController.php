<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Repository\SessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function detail(Formation $formation, ManagerRegistry $doctrine, SessionRepository $sr, Request $request): Response
    {   
        $today = date('d/m/Y');
        $id = $request->attributes->get('_route_params');

        $sessions = $doctrine->getRepository(Session::class)->findAll();
        $pastSessions = $sr->findPastSessionsByFormation($id);
        $currentSessions = $sr->findCurrentSessionsByFormation($id);
        $upcomingSessions = $sr->findUpcomingSessionsByFormation($id);
        return $this->render('formation/detail.html.twig', [
            'today' => $today,
            'formation' => $formation,
            'pastSessions' => $pastSessions,
            'currentSessions' => $currentSessions,
            'upcomingSessions' => $upcomingSessions,
        ]);
    }

    #[Route('/formation/{id}/delete', name: 'delete_session_formation')]
    public function delete(ManagerRegistry $doctrine, Session $session) {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('detail_formation', ['id' => $session->getFormation()->getId()]);
    }

}
