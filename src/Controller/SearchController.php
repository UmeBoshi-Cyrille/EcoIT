<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function searchFormation(): Response
    {
        return $this->render('base/formations.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
