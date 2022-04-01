<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPagesController extends AbstractController
{
    #[Route('/admin/home', name: 'admin_home')]
    public function adminHome(): Response
    {
        return $this->render('admin/home_admin.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/admin/instructors', name: 'admin_instructors')]
    public function adminInstructors(): Response
    {
        return $this->render('admin/instructors_admin.html.twig', [
            'instructors' => 'instructors',
        ]);
    }

    #[Route('/admin/students', name: 'admin_students')]
    public function adminStudents(): Response
    {
        return $this->render('NotYet/notYet_admin.html.twig', [
            'students' => 'Students',
        ]);
    }
}
