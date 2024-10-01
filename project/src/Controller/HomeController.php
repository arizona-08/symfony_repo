<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController{

    #[Route(path: '/', name: "index")]
    public function index(): Response
    {
        return $this->render("index.html.twig");
    }

    #[Route(path: '/discover', name: "discover")]
    public function discover(): Response
    {
        return $this->render("movie/discover.html.twig");
    }

    #[Route(path: '/page2', name: "page2")]
    public function page2(): Response
    {
        return new Response("Coucou");
    }
}