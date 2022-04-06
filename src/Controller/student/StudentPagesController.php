<?php

namespace App\Controller\student;

use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use App\Repository\SectionsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_STUDENT")]
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
    public function studentFormations(FormationRepository $formationRepository): Response
    {
        $studentFormations = $formationRepository->findAll();

        return $this->render('student/formations_student.html.twig', [
            'student_formations' => $studentFormations
        ]);
    }

    #[Route('/student/formation/{id}', name: 'student_formation')]
    public function studentFormation(int $id,
        FormationRepository $formationRepository
    ): Response
    {

        $studentFormation = $formationRepository->find($id);
        // $studentSections = $sectionsRepository-

        return $this->render('student/formation_student.html.twig', [
            'student_formation' => $studentFormation,
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
