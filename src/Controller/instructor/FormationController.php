<?php

namespace App\Controller\instructor;

use App\Entity\Formation;
use App\Entity\Section;
use App\Entity\Lesson;
use App\Form\FormationType;
use App\Form\SectionType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_INSTRUCTOR")]
#[Route('/instructor')]
class FormationController extends AbstractController
{
    #[Route('/formations', name: 'instructor_formations_index')]
    public function instructorFormationsIndex(FormationRepository $formationRepository): Response
    {
        $instructorFormations = $formationRepository->findAll();

        return $this->render('instructor/formations_instructor.html.twig', [
            'formationsIndex' => $instructorFormations
        ]);
    }

    #[Route('/formations/{id}', name: 'instructor_formation')]
    public function instructorFormation($id,
        FormationRepository $formationRepository
    ): Response
    {
        $instructorFormation = $formationRepository->find($id);

        return $this->render('instructor/formation_instructor.html.twig', [
            'instructor_formation' => $instructorFormation,
        ]);
    }

    #[Route('/formation/new', name: 'formation_new')]
    public function newFormation(Request $request, 
    EntityManagerInterface $entityManager): Response
    {
       $formation = new Formation();
       $formationForm = $this->createForm(FormationType::class, $formation);
       
       $section = new Section();
       $section->setTitle("title");
       $formation->getSections()->add($section);
       
       $originalSection = new ArrayCollection();
       foreach ($formation->getSections() as $section) {
           $originalSection->add($section);
       }

       $originalLesson = new ArrayCollection();
       foreach ($section->getLessons() as $lesson) {
            $originalLesson->add($lesson);
       }

       $formationForm->handleRequest($request);

       if ($formationForm->isSubmitted() && $formationForm->isValid()) {
            foreach ($originalSection as $section) {
                if ($formation->getSections()->contains($section) === false) {
                    $entityManager->remove($section);
                }
            }
        
            $entityManager->persist($formation);
            $entityManager->flush();

            $this->addFlash('success', 'Création réussie !');

            return $this->redirectToRoute('instructor_formations_index');
       }

       return $this->render('instructor/formation_new.html.twig', [
        'sectionForm' => $section,
        'formationForm' => $formationForm->createView()
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

        $formation = $this->createForm(FormationType::class, $formation);
        
        $formation->handleRequest($request);

        if ($formation -> isSubmitted() && $formation->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
        }

        return $this->render('instructor/formation_update.html.twig', [
            'formation_update' => $formation->createView()
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

    #[Route('/formation/delete/{id}', name: 'formation_delete')]
    public function deleteFormation($id, 
        FormationRepository $formationRepository, 
        EntityManagerInterface $entityManager): Response 
    {
        $formation = $formationRepository->find($id);

        $entityManager->remove($formation);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('instructor_formations_index');
    }
}
