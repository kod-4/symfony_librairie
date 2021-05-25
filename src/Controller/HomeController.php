<?php

namespace App\Controller;

use App\Entity\Home;
use App\Form\HomeType;
use App\Repository\HomeRepository;
use App\Repository\LivreRepository;
use App\Repository\CarouselRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function showHome(HomeRepository $homeRepository, CarouselRepository $carouselRepository, LivreRepository $livreRepository):Response{
        // Récupération des données
        $home = $homeRepository->findOneBy(["active"=>1]);
        $slides = $carouselRepository->findBy(["active"=>1], ["id"=>"DESC"]);
        $livres = $livreRepository->findBy(["consult"=>1]);

        // Rendu
        return $this->render('home/accueil.html.twig', [
            "home" => $home,
            "slides" => $slides,
            "livres" => $livres,
        ]);
    }

    #[Route('/admin/home', name: 'home_index', methods: ['GET'])]
    public function index(HomeRepository $homeRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'homes' => $homeRepository->findAll(),
        ]);
    }

    #[Route('/admin/home/new', name: 'home_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $home = new Home();
        $form = $this->createForm(HomeType::class, $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($home);
            $entityManager->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('home/new.html.twig', [
            'home' => $home,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/home/{id}', name: 'home_show', methods: ['GET'])]
    public function show(Home $home): Response
    {
        return $this->render('home/show.html.twig', [
            'home' => $home,
        ]);
    }

    #[Route('/admin/home/{id}/edit', name: 'home_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Home $home): Response
    {
        $form = $this->createForm(HomeType::class, $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('home/edit.html.twig', [
            'home' => $home,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/home/{id}', name: 'home_delete', methods: ['POST'])]
    public function delete(Request $request, Home $home): Response
    {
        if ($this->isCsrfTokenValid('delete'.$home->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($home);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_index');
    }
}
