<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Form\ProgrammeType;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use App\Repository\ProgrammeRepository;
use App\Repository\StagiaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine, SessionRepository $sr, Session $session = null, Request $request): Response
    { 
        if($this->getUser()){
            
            $today = new \DateTime();
            // récuperer les sessions de la bdd
            $pastSessions = $sr->findPastSessions();
            $currentSessions = $sr->findCurrentSessions();
            $upcomingSessions = $sr->findUpcomingSessions();

            $sessions = $doctrine->getRepository(Session::class)->findAll();
            $form = $this->createForm(SessionType::class, $session);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $session = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($session);
                $entityManager->flush();

                return $this->redirectToRoute('app_session');
            }
            return $this->render('session/index.html.twig', [
                'today' => $today,
                'pastSessions' => $pastSessions,
                'currentSessions' => $currentSessions,
                'upcomingSessions' => $upcomingSessions,
                'formAddSession' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_login');
            }
    }

    #[Route('/session/{id}', name: 'detail_session')]
    public function detail(ManagerRegistry $doctrine, Session $session, StagiaireRepository $sr, ModuleRepository $mr, Request $request): Response
    { 
        if($this->getUser()){
            
            $today = new \DateTime();
            $session_id = $session->getId();
            $programmes = $session->getProgrammes();
            $autresModules = $mr->findAutresModulesBySessionId($session_id);
            $stagiairesInscrits = $session->getStagiaires();
            $stagiairesNonInscrits = $sr->findStagiairesNonInscritsBySessionId($session_id);
            
            $form = $this->createForm(SessionType::class, $session);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $session = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($session);
                $entityManager->flush();

                return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
            }

            return $this->render('session/detail.html.twig', [
                'session' => $session,
                'programmes' => $programmes,
                'autresModules' => $autresModules,
                'stagiairesInscrits' => $stagiairesInscrits,
                'stagiairesNonInscrits' => $stagiairesNonInscrits,
                'formAddSession' => $form->createView(),
                'today' => $today
            ]);
        } else {
            return $this->redirectToRoute('app_login');
            }
    }

    #[Route('/session/{id}/ajouterProgramme/{moduleId}', name: 'ajouter_programme')]
    public function ajouterProgramme(ManagerRegistry $doctrine, Session $session, $moduleId)
    { 
        if($this->getUser()){
            
            if(isset($_POST['submitProgramme'])){
                $duree =filter_input(INPUT_POST,"duree",FILTER_VALIDATE_INT);
                if($duree > 0){
                    $entityManager = $doctrine->getManager();
                    $module = $entityManager->getRepository(Module::class)->find($moduleId);
                    $programme = new Programme();
                    $programme->setDuree($duree);
                    $programme->setModule($module);
                    $programme->setSession($session);
                    $entityManager->persist($programme);
                    $entityManager->flush();
                    return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
                }
            } else {
                return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
                }
        } else {
            return $this->redirectToRoute('app_login');
            }
    }

    #[Route('/session/{id}/retirerProgramme/{programmeId}', name: 'retirer_programme')]
    public function retirerProgramme(ManagerRegistry $doctrine, Session $session,ProgrammeRepository $pr, $programmeId)
    { 
        if($this->getUser()){
            
            $entityManager = $doctrine->getManager();
            $programme = $entityManager->getRepository(Programme::class)->find($programmeId);
            $pr->remove($programme);
            $entityManager->flush();

            return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
        } else {
            return $this->redirectToRoute('app_login');
            }
    } 

    #[Route('/session/{id}/desinscrire/{stagiaireId}', name: 'desinscrire_stagiaire')]
    public function desinscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        if($this->getUser()){
        
            $entityManager = $doctrine->getManager();
            $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
            $session->removeStagiaire($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
        } else {
        return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/session/{id}/inscrire/{stagiaireId}', name: 'inscrire_stagiaire')]
    public function inscrireStagiaire(ManagerRegistry $doctrine, Session $session, $stagiaireId)
    {
        if($this->getUser()){

            $entityManager = $doctrine->getManager();
            $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagiaireId);
            $session->addStagiaire($stagiaire);
            $entityManager->flush();
    
            return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(ManagerRegistry $doctrine, Session $session)
    {
        if($this->getUser()){

        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
        } else {
            return $this->redirectToRoute('app_login');
        }
    }
}
