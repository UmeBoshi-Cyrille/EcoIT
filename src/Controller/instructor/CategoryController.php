<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instructor')]
class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/categoryList', name: 'categoryList')]
    public function listCategories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('', [ //render : abstract controller
            'categories' => $categories
        ]);
    }

    #[Route('/category/{id}/delete', name: 'delete_category')]
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        // récupérer article à supprimer
        $category = $categoryRepository->find($id);
        // supprimer l'article.
        $entityManager->remove($category);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie !');

        return $this->redirectToRoute('');
    }

    #[Route('/category/new', name: 'new_category')]
    public function insertCategory(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Création réussie !');

            return $this->redirectToRoute('categoryList');
        }

        return $this->render('', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    #[Route('/category/{id}/update', name: 'update_category')]
    public function updateCategory($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('categoryList'); // redirection
        }

        return $this->render('', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }
}
