<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/admin")]
class AdminController extends AbstractController{
    //plus besoin d'ajouter '/admin' pour chaque route
    #[Route(path: "/home", name: "admin_homepage")]
    public function homePage(): Response{
        return $this->render("admin/admin.html.twig");
    }

    #[Route(path: "/users", name: "admin_users")]
    public function users(): Response{
        return $this->render("admin/admin_users.html.twig");
    }

    #[Route(path: "/films", name: "admin_films")]
    public function films(): Response{
        return $this->render("admin/admin_films.html.twig");
    }

    #[Route(path: "/add_films", name: "admin_add_films")]
    public function add_films(): Response{
        return $this->render("admin/admin_add_films.html.twig");
    }
}