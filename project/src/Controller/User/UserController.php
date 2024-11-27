<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController{
    #[Route(path: '/profile', name: 'profile')]
    public function profile(): Response{
        return new Response("profile page");
    }
}