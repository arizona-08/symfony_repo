<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController{

    #[Route(path: '/', name: "index")]
    public function index(MediaRepository $mediaRepository): Response
    {
        $medias = $mediaRepository->findAll();
        return $this->render("index.html.twig", ["medias" => $medias]);
    }

    #[Route(path: '/page2', name: "page2")]
    public function page2(): Response
    {
        return new Response("Coucou");
    }
}