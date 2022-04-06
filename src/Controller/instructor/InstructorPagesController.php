<?php

namespace App\Controller\instructor;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_INSTRUCTOR")]
class InstructorPagesController extends AbstractController
{
    #[Route('/instructor/home', name: 'instructor_home')]
    public function instructorHome(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUCTOR', null, 'User tried to access a page without having ROLE_INSTRUCTOR');

        return $this->render('instructor/home_instructor.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/instructor/formations', name: 'instructor_formations')]
    public function instructorFormations(FormationRepository $formationRepository): Response
    {
        $instructorFormations = $formationRepository->findAll();

        return $this->render('instructor/formations_instructor.html.twig', [
            'instructor_formations' => $instructorFormations
        ]);
    }

    #[Route('/instructor/formation/insert', name: 'formation_insert')]
    public function formationInsert(): Response
    {
        return $this->render('instructor/formation_insert.html.twig', [
            'formation' => 'Formation',
        ]);
    }
}
