<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'EcoIT' => 'EcoIt',
        ]);
    }

    #[Route('/home/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('login/login.html.twig', [
            'login' => 'Login',
        ]);
    }

    #[Route('/home/subscribe', name: 'subscribe')]
    public function subscribe(): Response
    {
        return $this->render('login/subscribe.html.twig', [
            'subscribe' => 'Subscribe',
        ]);
    }
}
