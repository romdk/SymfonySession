<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route(path: '/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/userEdit/{id}', name: 'edit_user')]
    public function edit(ManagerRegistry $doctrine, User $user, Request $request, SluggerInterface $slugger): Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $file = $form->get('image')->getData();

        if ($file) {
            // recupere le nom du fichier original
            $originalFileName = pathinfo($file->getClientOriginalName(), flags:PATHINFO_FILENAME);
            // trasforme le nom du fichier en une string qui contient que des caracteres ASCII
            $safeFileName = $slugger->slug($originalFileName);
            // ajout un id unique au fichier pour eviter les doublons
            $newFileName = $safeFileName.'-'.uniqid().'.'.$file->guessExtension();

            // deplace le fichier uploader dans le bon dossier
            try{
                $file->move(
                    $this->getParameter(name:'user_directory'),
                    $newFileName
                );
            } catch (FileExeption $e) {

            }

            $user->setImage($newFileName);
        }

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('edit_user', ['id' => $user->getId()]);
        }

        return $this->render('security/userEdit.html.twig', [
            'formEditUser' => $form->createView(),
        ]);
    }
}
