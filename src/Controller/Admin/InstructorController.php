<?php

namespace App\Controller\Admin;

use App\Form\InstructorType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Vich\UploaderBundle\Form\Type\VichImageType;

#[Route('/admin')]
class InstructorController extends AbstractController
{
    #[Route('/instructors', name: 'admin_instructors')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();

        return $this->render('admin/instructors_admin.html.twig', [
            'instructors' => $user
        ]);
    }

    #[Route('/instructor/delete/{id}', name: 'admin_instructor_delete')]
    public function deleteAccount($id, 
        UserRepository $userRepository, 
        EntityManagerInterface $entityManager): Response 
    {
        $user = $userRepository->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('admin_instructors');
    }

    #[Route('/instructor/update/{id}', name: 'admin_instructor_update')]
    public function updateRole(
        $id, 
        UserRepository $userRepository, 
        Request $request, 
        EntityManagerInterface $entityManager):Response
    {
        $role = $userRepository->find($id);

        $instructorForm = $this->createForm(InstructorType::class, $role);

        $instructorForm->handleRequest($request);

        if ($instructorForm->isSubmitted() && $instructorForm->isValid()) {
            $entityManager->persist($role);
            $entityManager->flush();

            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('admin_instructors');
        }

        return $this->render('admin/instructor_update.html.twig', [
            'instructor' => $role,
            'instructorForm' => $instructorForm->createView()
        ]);
    }

    #[Route('/instructors/search', name: 'admin_instructors_search')]
    public function adminInstructorSearch(
        Request $request,
        UserRepository $userRepository)
    {

        $search = $request->query->get('search');
        $users = $userRepository->searchUser($search); 
        
        return $this->render('admin/instructors-search_admin.html.twig', [
            'instructors' => $users
        ]);
    }
}
