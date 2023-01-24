<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Referent;
use App\Form\ReferentType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReferentController extends AbstractController
{
    #[Route('/referent', name: 'app_referent')]
    public function index(ManagerRegistry $doctrine, Referent $referent = null, Request $request): Response
    {
        if($this->getUser()){
            if(!$referent) {
                $referent = new Referent();
            }

            $referents = $doctrine->getRepository(Referent::class)->findAll();
            $form = $this->createForm(ReferentType::class, $referent);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $referent = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($referent);
                $entityManager->flush();

                return $this->redirectToRoute('app_referent');
            }
            return $this->render('referent/index.html.twig', [
                'referents' => $referents,
                'formAddReferent' => $form->createView()
            ]);
            
        } else {
            return $this->redirectToRoute('app_login');
            }
    }

    #[Route('/referent/{id}', name: 'detail_referent')]
    public function detail(ManagerRegistry $doctrine, Referent $referent, Request $request): Response
    {   
        if($this->getUser()){
            $sessionsReferent = $referent->getSessions();
            $today = new \DateTime();

            $form = $this->createForm(ReferentType::class, $referent);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $referent = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($referent);
                $entityManager->flush();

                return $this->redirectToRoute('detail_referent', ['id' => $referent->getId()]);
            }

            return $this->render('referent/detail.html.twig', [
                'referent' => $referent,
                'sessionsReferent' => $sessionsReferent,
                'today' => $today,
                'formAddReferent' => $form->createView()
            ]);

        } else {
            return $this->redirectToRoute('app_login');
            }
    }

    #[Route('/referent/{id}/delete', name: 'delete_referent')]
    public function delete(ManagerRegistry $doctrine, Referent $referent)
    {
        if($this->getUser()){
            $entityManager = $doctrine->getManager();
            $entityManager->remove($referent);
            $entityManager->flush();    

            return $this->redirectToRoute('app_referent');

        } else {
            return $this->redirectToRoute('app_login');
            }
    }
    
}
