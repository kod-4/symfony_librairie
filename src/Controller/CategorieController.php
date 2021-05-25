<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categories/detail/{id}', name: 'categorie_detail')]
    public function detailFront($id, CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/detail.html.twig', [
            'categories' => $categorieRepository->find($id),
        ]);
    }
    #[Route('/categories', name: 'categories')]
    public function indexFront(CategorieRepository $categorieRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $categories = $categorieRepository->findBy(["active"=>1], ["titre"=>"ASC"]);
        $pagination = $paginator->paginate($categories, $request->query->getInt('page', 1), 6);
        return $this->render('categorie/index-front.html.twig', [
            'categories' => $pagination,
        ]);
    }
    #[Route('/admin/categorie', name: 'categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/admin/categorie/new', name: 'categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categorie/{id}', name: 'categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/admin/categorie/{id}/edit', name: 'categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/categorie/{id}', name: 'categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }
}
