<?php

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/other")]
class OtherController extends AbstractController{

    #[Route(path: "/subscribtions", name: "subscribtions")]
    public function subscriptions(): Response{
        $user = $this->getUser();
        return $this->render("other/abonnements.html.twig", ["logged_user" => $user]);
    }

    #[Route(path: '/settings', name: 'settings')]
    public function settings(): Response{
        $user = $this->getUser();
        return $this->render("other/settings.html.twig", ["logged_user" => $user]);
    }
}