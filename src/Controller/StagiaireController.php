<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(ManagerRegistry $doctrine, Stagiaire $stagiaire = null, Request $request): Response
    {
        $stagiaires = $doctrine->getRepository(Stagiaire::class)->findAll();
        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $stagiaire = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_stagiaire');
        }
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
            'formAddStagiaire' => $form->createView()
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
