<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentPagesController extends AbstractController
{
    #[Route('/student/home', name: 'student_home')]
    public function studentHome(): Response
    {
        return $this->render('student/home_student.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/student/contact', name: 'student_contact')]
    public function studentContact(): Response
    {
        return $this->render('student/contact_student.html.twig', [
            'contact' => 'Contact',
        ]);
    }

    #[Route('/student/apply', name: 'student_apply')]
    public function studentApply(): Response
    {
        return $this->render('login/apply_student.html.twig', [
            'apply' => 'Apply',
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

    #[Route('/student/notYet', name: 'notYet')]
    public function notYet(): Response
    {
        return $this->render('NotYet/notYet_student.html.twig', [
            'not' => 'NotYet',
        ]);
    }
}
