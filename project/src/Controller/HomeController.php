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
        $user = $this->getUser();
        $medias = $mediaRepository->findAll();
        return $this->render("index.html.twig", ["medias" => $medias, "logged_user" => $user]);
    }
}