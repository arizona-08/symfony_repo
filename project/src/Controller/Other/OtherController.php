<?php

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/other")]
class OtherController extends AbstractController{

    #[Route(path: "/subscribtions", name: "subscribtions")]
    public function subscriptions(){
        return $this->render("other/abonnements.html.twig");
    }

    #[Route(path: '/settings', name: 'settings')]
    public function settings(): Response{
        return new Response("Settings page");
    }
}