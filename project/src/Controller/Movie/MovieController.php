<?php

namespace App\Controller\Movie;

use App\Entity\Category;
use App\Entity\Media;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/movie")]
class MovieController extends AbstractController {
    #[Route(path: "/discover", name: "discover")]
    public function discover(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render("movie/discover.html.twig", ["categories" => $categories]);
    }

    #[Route(path: "/lists", name: "lists")]
    public function lists(PlaylistRepository $playlistRepository): Response {
        $playlists = $playlistRepository->findAll();
        return $this->render("movie/lists.html.twig", ["playlists" => $playlists]);
    }

    #[Route(path: "/detail", name: "detail")]
    public function detail(): Response {
        return $this->render("movie/detail.html.twig");
    }

    #[Route(path: "/detail_serie/{id}", name: "detail_serie")]
    public function detail_serie(Media $media): Response {
        return $this->render("movie/detail_serie.html.twig", ["media" => $media]);
    }

    #[Route(path: "/category/{id}", name: "category")]
    public function category(Category $category, MediaRepository $mediaRepository): Response {
        $tendancies = $mediaRepository->findSomeMedias(3);
        return $this->render("movie/category.html.twig", 
        [
            "category" => $category, 
            "tendancies" => $tendancies
        ]);
    }
}