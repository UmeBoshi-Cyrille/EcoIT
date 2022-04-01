<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstructorPagesController extends AbstractController
{
    #[Route('/instructor/home', name: 'instructor_home')]
    public function instructorHome(): Response
    {
        return $this->render('instructor/home_instructor.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/instructor/formations', name: 'instructor_formations')]
    public function instructorFormations(): Response
    {
        return $this->render('instructor/formations_instructor.html.twig', [
            'formations' => 'Formations',
        ]);
    }

    #[Route('/instructor/formation', name: 'instructor_formation')]
    public function instructorFormation(): Response
    {
        return $this->render('instructor/formation_instructor.html.twig', [
            'formation' => 'Formation',
        ]);
    }
}
