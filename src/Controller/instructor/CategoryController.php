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

     /**
     * @Route("/admin/category/{id}/delete", name="admin_category_delete")
     */
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


    /**
     * @Route("/admin/category/insert", name="admin_category_insert")
     */
    public function insertCategory(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Création réussie !');

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    /**
     * @Route("/admin/category/{id}/update", name="admin_category_update")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('admin_categories'); // redirection
        }

        return $this->render('', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }
}
