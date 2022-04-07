<?php

namespace App\Controller\instructor;

use App\Entity\Formation;
use App\Entity\Section;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instructor')]
class FormationController extends AbstractController
{
    // #[Route('/formation/{id}', name: 'app_formation')]
    // public function formation(int $id,
    //     FormationRepository $formationRepository): Response
    // {
    //     $formation = $formationRepository->find($id);

    //     return $this->render('student/formation_student.html.twig', [
    //         'formation' => $formation
    //     ]);
    // }

    #[Route('/formation/new', name: 'formation_new')]
    public function newFormation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();

        $sections = new Section();
        $sections->setTitle('section1');
        $formation->getSections()->add($sections);

        $formationForm = $this->createForm(FormationType::class, $formation);

        $formationForm->handleRequest($request);

        if ($formationForm->isSubmitted() && $formationForm->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();

            $this->addFlash('success', 'Création réussie !');

            return $this->redirectToRoute('instructor_formations');
        }

        return $this->render('instructor/formation_new.html.twig', [
            'formationForm' => $formationForm->createView()
        ]);
    }

    #[Route('/formation/update', name: 'formation_update')]
    public function updateFormation($id, 
        FormationRepository $formationRepository, 
        Request $request, 
        EntityManagerInterface $entityManager):Response
    {
        $formation = $formationRepository->find($id);

        $formationForm = $this->createForm(FormationType::class, $formation);

        $formationForm->handleRequest($request);

        if ($formationForm->isSubmitted() && $formationForm->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();

            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('instructor/formations_instructor.html.twig', [
                'formationForm' => $formationForm->createView()
            ]);
        }
    }

    public function deleteFormation($id, 
        FormationRepository $formationRepository, 
        EntityManagerInterface $entityManager): Response 
    {
        $formation = $formationRepository->find($id);

        $entityManager->remove($formation);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('instructor/formations_instructor.html.twig');
    }
}
