<?php

namespace App\Controller\instructor;

use App\Entity\Formation;
use App\Entity\Section;
use App\Entity\Lessons;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instructor')]
class FormationController extends AbstractController
{
    #[Route('/formations', name: 'instructor_formations')]
    public function instructorFormations(FormationRepository $formationRepository): Response
    {
        $instructorFormations = $formationRepository->findAll();

        return $this->render('instructor/formations_instructor.html.twig', [
            'instructor_formations' => $instructorFormations
        ]);
    }

    #[Route('/formation/new', name: 'formation_new')]
    public function newFormation(
        Request $request, 
        EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();

        $section1 = new Section();
        $section1->setTitle('premier');
        $formation->getSections()->add($section1);
        $lesson1 = new Lessons();
        $lesson1->setTitle('premier');
        $formation->getLessons()->add($lesson1);


        $originalSection = new ArrayCollection();

        foreach ($formation->getSections() as $section) {
            $originalSection->add($section);
        }

        $originalLesson = new ArrayCollection();

        foreach ($formation->getLessons() as $lesson) {
            $originalLesson->add($lesson);
        }

        $formation = $this->createForm(FormationType::class, $formation);
        
        $formation->handleRequest($request);

        if ($formation->isSubmitted() && $formation->isValid()) {
            // get rid of one section
            foreach ($originalSection as $section) {
                if ($entityManager->$formation->getSections()->contains($section) === false) {
                    $entityManager->remove($section);
                }
            }

            foreach ($originalLesson as $lesson) {
                if ($entityManager->$formation->getLessons()->contains($lesson) === false) {
                    $entityManager->remove($lesson);
                }
            }

            $entityManager->persist($formation);
            $entityManager->flush();
        }

        return $this->render('instructor/formation_new.html.twig', [
            'formationForm' => $formation->createView()
        ]);
    }

    /**

     * @param App\Entity\Formation;
     */
    #[Route('/formation/update/{id}', name: 'formation_update')]
    public function updateFormation(
        $id,
        Request $request, 
        EntityManagerInterface $entityManager,
        FormationRepository $formationRepository): Response
    {
        $formation = $formationRepository->findOneBy(['id' => $id]);
        
        $originalSection = new ArrayCollection();

        foreach ($formation->getSections() as $section) {
            $originalSection->add($section);
        }

        $originalLesson = new ArrayCollection();

        foreach ($formation->getLessons() as $lesson) {
            $originalLesson->add($lesson);
        }

        $formation = $this->createForm(FormationType::class, $formation);
        
        $formation->handleRequest($request);

        if ($formation -> isSubmitted() && $formation->isValid()) {
            foreach ($originalSection as $section) {
                if ($entityManager->$formation->getSections()->contains($section) === false) {
                    $entityManager->remove($section);
                }
            }
            
            foreach ($originalLesson as $lesson) {
                if ($entityManager->$formation->getLessons()->contains($lesson) === false) {
                    $entityManager->remove($lesson);
                }
            }
            
            $entityManager->persist($formation);
            $entityManager->flush();
        }

        return $this->render('instructor/formation_update.html.twig', [
                    'formationForm' => $formation->createView()
                ]);
    }
    
    // #[Route('/formation/{id}', name: 'app_formation')]
    // public function formation(int $id,
    //     FormationRepository $formationRepository): Response
    // {
    //     $formation = $formationRepository->find($id);

    //     return $this->render('student/formation_student.html.twig', [
    //         'formation' => $formation
    //     ]);
    // }

   
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
