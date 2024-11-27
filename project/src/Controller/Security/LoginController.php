<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/login")]
class LoginController extends AbstractController{
    #[Route(path: '/', name: "login")]
    public function login(): Response
    {
        //retourne la vue pour le login
        return $this->render("auth/login.html.twig");
    }

    #[Route(path: '/confirm', name: "confirm")]
    public function confirm(): Response
    {
        //retourne la vue pour le confirm
        return $this->render("auth/confirm.html.twig");
    }

    #[Route(path: '/forgot', name: "forgot")]
    public function forgot(): Response
    {
        //retourne la vue pour le forgot
        return $this->render("auth/forgot.html.twig");
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): Response {
        return new Response("logged out");
    }
}