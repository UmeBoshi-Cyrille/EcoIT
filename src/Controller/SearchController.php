<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function searchFormation(
        Request $request,
        FormationRepository $formationRepository)
    {

        $search = $request->query->get('search');
        $formations = $formationRepository->searchFormation($search);

        return $this->render('base/search_formations.html.twig', [
            'formations' => $formations
        ]);
    }

    #[Route('/student/search', name: 'student_search')]
    public function studentSearchFormation(
        Request $request,
        FormationRepository $formationRepository)
    {

        $search = $request->query->get('search');
        $formations = $formationRepository->searchFormation($search);

        return $this->render('student/studentSearch_formations.html.twig', [
            'formations' => $formations
        ]);
    }
}
