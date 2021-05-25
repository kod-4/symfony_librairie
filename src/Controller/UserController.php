<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Liste;
use App\Form\UserType;
use App\Form\UserCompteType;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/add', name: 'add', methods: ['POST'])]
    public function addList(Request $request, LivreRepository $livreRepository): Response
    {
        $idLivre = $request->request->get("idLivre");
        $livre = $livreRepository->find($idLivre);
        $user = $this->getUser();
        $ok = true;

        $liste = new Liste();
        $liste->setUser($user);
        $liste->setLivre($livre);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($liste);
        $entityManager->flush();

        return new Response("OK pour livre id=".$idLivre);

    }

    #[Route('/compte', name: 'compte')]
    public function compte(Request $request, UserPasswordEncoderInterface $encoder, SessionInterface $session):Response{
        // Mise en place du formulaire d'après les informations de l'utilisateur connecté
        $user = $this->getUser();
        if(empty($session->get('password'))){
            $session->set('password', $user->getPassword());
        }
        $form = $this->createForm(UserCompteType::class, $user);
        // On hydrate le formulaire avec les données de la requête
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(is_null($user->getPassword())){ 
                // On récupère le mot de passe actuel dans la session
                $user->setPassword($session->get('password'));
            }else{   
                $plainPassword = $user->getPassword();
                $encodedPassword = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encodedPassword);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
        }
        
        return $this->render('user/compte.html.twig', ["form"=>$form->createView()]);
    }
   
    #[Route('/inscription', name: 'user_inscription')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        // Mise en place d'un formulaire afin d'en envoyer la vue au twig
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // On hydrate le formulaire
        $form->handleRequest($request);
        // Si le formulaire est renvoyé et valid quand on passe dans la méthode
        if($form->isSubmitted() && $form->isValid()){
            // On affecte un rôle à l'utilisateur car il n'y a pas de chois de role dans le formulaire
            $user->setRoles(['ROLE_USER']);
            $originePassword = $user->getPassword();
            $encodedPassword = $encoder->encodePassword($user, $originePassword);
            $user->setPassword($encodedPassword);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('validation');
        }
        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/validation', name: 'validation')]
    public function confirmation(){
        return new Response('Inscription réussi');
    }

}
