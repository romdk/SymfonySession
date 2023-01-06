<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // récuperer les stagiaires de la bdd
        $stagiaires = $doctrine->getRepository(Stagiaire::class)->findAll();
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires
        ]);
    }

    #[Route('/stagiaire/{id}', name: 'detail_stagiaire')]
    public function detail(Stagiaire $stagiaire, ManagerRegistry $doctrine, Request $request, Session $session): Response
    {   
        // $id = $request->attributes->get('_route_params');

        return $this->render('stagiaire/detail.html.twig', [
        ]);
    }
}
