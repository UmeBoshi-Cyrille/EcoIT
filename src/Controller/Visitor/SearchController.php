<?php

namespace App\Controller\Visitor;

use App\Repository\FormationRepository;
use App\Repository\UserRepository;
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

//     /**
//     * @Route("/searh-results/{search}",name="search_results")
//     */
//     public function results($search, ArticleRepository $articleRepository)
//     {
//         // méthode pour Optimisation de l'URL pour Référencement (SEO)
//         $articles = $articleRepository->searchArticle($search);

//        return $this->render('search_articles.html.twig', [
//            'articles' => $articles,
//            'search' => $search
//        ]); 
//     }


//    /**
//     * @Route("/search-results", name="search")
//     */
//    public function searchArticle(Request $request): Response
//    {
//        // Récupérer données de la recherche
//        $search = $request->query->get(key: 'search');
//        // Faire la recherche en BDD
//        return $this->redirectToRoute('search_results', ['search' => $search]);
//    }
}
