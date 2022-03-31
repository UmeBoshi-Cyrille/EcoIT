<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'EcoIT' => 'EcoIt',
        ]);
    }

    #[Route('/home/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('login/login.html.twig', [
            'login' => 'Login',
        ]);
    }

    #[Route('/home/subscribe', name: 'subscribe')]
    public function subscribe(): Response
    {
        return $this->render('login/subscribe.html.twig', [
            'subscribe' => 'Subscribe',
        ]);
    }

    #[Route('/home/apply', name: 'apply')]
    public function apply(): Response
    {
        return $this->render('login/apply.html.twig', [
            'apply' => 'Apply',
        ]);
    }

    #[Route('/student/apply', name: 'student_apply')]
    public function studentApply(): Response
    {
        return $this->render('login/apply_student.html.twig', [
            'apply' => 'Apply',
        ]);
    }

    #[Route('/home/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('base/contact.html.twig', [
            'contact' => 'Contact',
        ]);
    }

    #[Route('/student/contact', name: 'student_contact')]
    public function studentContact(): Response
    {
        return $this->render('student/contact_student.html.twig', [
            'contact' => 'Contact',
        ]);
    }


    #[Route('/home/formations', name: 'formations')]
    public function formation(): Response
    {
        return $this->render('base/formations.html.twig', [
            'formations' => 'Formations',
        ]);
    }

    #[Route('/student/home', name: 'student_home')]
    public function studentHome(): Response
    {
        return $this->render('student/home_student.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/student/formations', name: 'student_formations')]
    public function studentFormations(): Response
    {
        return $this->render('student/formations_student.html.twig', [
            'formations' => 'Formations',
        ]);
    }

    #[Route('/student/formation', name: 'student_formation')]
    public function studentFormation(): Response
    {
        return $this->render('student/formation_student.html.twig', [
            'formation' => 'Formation',
        ]);
    }
}
