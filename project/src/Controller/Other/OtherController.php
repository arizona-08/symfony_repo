<?php

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/other")]
class OtherController extends AbstractController{

    #[Route(path: "/subscribtions", name: "subscribtions")]
    public function subscriptions(){
        return $this->render("other/abonnements.html.twig");
    }
}