<?php

namespace App\Controller\Admin;

use App\Form\InstructorType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    // #[Route('/activate', name: 'instructor_activation')]
    public function updateRoles($id, 
        UserRepository $userRepository, 
        Request $request, 
        EntityManagerInterface $entityManager):Response
    {
        $role = $userRepository->find($id);

        $userRoleForm = $this->createForm(InstructorType::class, $role);

        $userRoleForm->handleRequest($request);

        if ($userRoleForm->isSubmitted() && $userRoleForm->isValid()) {
            $entityManager->persist($role);
            $entityManager->flush();

            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('admin/instructors_admin.html.twig', [
                'userRoleForm' => $userRoleForm
            ]);
        }
    }
}
