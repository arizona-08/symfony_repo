<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route(path: "/admin")]
class AdminController extends AbstractController{
    //plus besoin d'ajouter '/admin' pour chaque route
    #[Route(path: "/home", name: "admin_homepage")]
    public function homePage(): Response{
        $user = $this->getUser();
        return $this->render("admin/admin.html.twig", ["logged_user" => $user]);
    }

    #[Route(path: "/users", name: "admin_users")]
    public function users(): Response{
        $user = $this->getUser();
        return $this->render("admin/admin_users.html.twig", ["logged_user" => $user]);
    }

    #[Route(path: "/films", name: "admin_films")]
    public function films(): Response{
        $user = $this->getUser();
        return $this->render("admin/admin_films.html.twig", ["logged_user" => $user]);
    }

    #[Route(path: "/add_films", name: "admin_add_films")]
    public function add_films(): Response{
        $user = $this->getUser();
        return $this->render("admin/admin_add_films.html.twig", ["logged_user" => $user]);
    }
}