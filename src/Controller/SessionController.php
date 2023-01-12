<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine, SessionRepository $sr): Response
    {
        $today = date('d/m/Y');
        // récuperer les sessions de la bdd
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

    #[Route('/session/{id}', name: 'detail_session')]
    public function detail(Session $session, StagiaireRepository $sr, ModuleRepository $mr): Response
    {
        $session_id = $session->getId();
        $programmes = $session->getProgrammes();
        $autresModules = $mr->findAutresModulesBySessionId($session_id);
        $stagiairesInscrits = $session->getStagiaires();
        $stagiairesNonInscrits = $sr->findStagiairesNonInscritsBySessionId($session_id);   
        return $this->render('session/detail.html.twig', [
            'session_id' => $session_id,          
            'programmes' => $programmes,
            'autresModules' => $autresModules,
            'stagiairesInscrits' => $stagiairesInscrits,
            'stagiairesNonInscrits' => $stagiairesNonInscrits,  
        ]);
    }

    #[Route('/session/{id}/retirerProgramme/{programmeId}', name: 'retirer_programme')]
    public function retirerProgramme(ManagerRegistry $doctrine, Session $session, $programmeId)
    {
        $entityManager = $doctrine->getManager();
        $programme = $entityManager->getRepository(Programme::class)->find($programmeId);
        $session->removeProgramme($programme);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }

    #[Route('/session/{id}/ajouterProgramme/{moduleId}', name: 'ajouter_programme')]
    public function ajouterModule(ManagerRegistry $doctrine, Session $session, $moduleId)
    {
        $entityManager = $doctrine->getManager();
        $programme = $entityManager->getRepository(Programme::class)->find($moduleId);
        $session->addProgramme($programme);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }

    #[Route('/session/{id}/desinscrire/{stagiaireId}', name: 'desinscrire_stagiaire')]
    public function desinscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
        $session->removeStagiaire($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }

    #[Route('/session/{id}/inscrire/{stagiaireId}', name: 'inscrire_stagiaire')]
    public function inscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
        $session->addStagiaire($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(ManagerRegistry $doctrine, Session $session) {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
    }
}
