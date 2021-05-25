<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use App\Repository\AuteurRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AuteurController extends AbstractController
{
    #[Route('/auteur/detail/{id}', name: 'auteur_detail')]
    public function auteurDetail($id, AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/auteur.html.twig', [
            'auteur' => $auteurRepository->find($id),
        ]);
    }
    #[Route('/admin/auteur', name: 'auteur_index', methods: ['GET'])]
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/index.html.twig', [
            'auteurs' => $auteurRepository->findAll(),
        ]);
    }

    #[Route('/admin/auteur/new', name: 'auteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();

            return $this->redirectToRoute('auteur_index');
        }

        return $this->render('auteur/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteur/{id}', name: 'auteur_show', methods: ['GET'])]
    public function show(Auteur $auteur): Response
    {
        return $this->render('auteur/show.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    #[Route('/admin/auteur/{id}/edit', name: 'auteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Auteur $auteur, LivreRepository $livreRepository): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livres = $livreRepository->findBy(["auteur"=>$auteur->getId()]);
            foreach($livres as $livre){
                $livre->setAuteur(null);
                $this->getDoctrine()->getManager()->persist($auteur);
            }
            foreach($auteur->getLivres() as $livre){
                $livre->setAuteur($auteur);
                $this->getDoctrine()->getManager()->persist($auteur);
            }
            $auteur = $form->getData();
            $this->getDoctrine()->getManager()->persist($auteur);

            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auteur_index');
        }

        return $this->render('auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/auteur/{id}', name: 'auteur_delete', methods: ['POST'])]
    public function delete(Request $request, Auteur $auteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($auteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('auteur_index');
    }
}
