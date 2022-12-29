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
        $sessions = $doctrine->getRepository(Session::class)->findAll();
        $today = date('d/m/Y');
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
            'today' => $today,
        ]);
    }
}
