<?php

namespace App\Controller\Movie;

use App\Entity\Category;
use App\Entity\Media;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/movie")]
class MovieController extends AbstractController {
    #[Route(path: "/discover", name: "discover")]
    public function discover(CategoryRepository $categoryRepository): Response
    {

        $user = $this->getUser();
        $categories = $categoryRepository->findAll();
        return $this->render("movie/discover.html.twig", ["categories" => $categories, "logged_user" => $user]);
    }

    #[Route(path: "/lists", name: "lists")]
    public function lists(PlaylistRepository $playlistRepository): Response {

        $user = $this->getUser();
        $playlists = $playlistRepository->findAll();
        return $this->render("movie/lists.html.twig", ["playlists" => $playlists, "logged_user" => $user]);
    }

    #[Route(path: "/list/{id}", name: "list")]
    public function showLists(PlaylistRepository $playlistRepository, int $id): Response {

        $user = $this->getUser();
        $playlists = $playlistRepository->findAll();

        $selectedPlaylist = $playlistRepository->find($id);
        // dd($selectedPlaylist->getPlaylistMedia()[0]->getMedia()->getCoverImage());
        return $this->render("movie/lists.html.twig", [
            "playlists" => $playlists, 
            "selectedPlaylist" => $selectedPlaylist,
            "logged_user" => $user
        ]);
    }

    #[Route(path: "/detail_film/{id}", name: "detail_film")]
    public function detail(Media $media): Response {

        $user = $this->getUser();
        return $this->render("movie/detail_film.html.twig", [
            "media" => $media,
            "logged_user" => $user,
        ]);
    }

    #[Route(path: "/detail_serie/{id}", name: "detail_serie")]
    public function detail_serie(Media $media): Response {

        $user = $this->getUser();
        return $this->render("movie/detail_serie.html.twig", ["media" => $media, "logged_user" => $user]);
    }

    #[Route(path: "/category/{id}", name: "category")]
    public function category(Category $category, CategoryRepository $categoryRepository, MediaRepository $mediaRepository): Response {

        $user = $this->getUser();
        $tendancies = $mediaRepository->findSomeMedias(3);
        $categories = $categoryRepository->findAll();
        return $this->render("movie/category.html.twig", 
        [
            "category" => $category,
            "categories" => $categories, 
            "tendancies" => $tendancies, 
            "logged_user" => $user
        ]);
    }
}