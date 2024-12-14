<?php

namespace App\Controller\Other;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route("/other")]
class OtherController extends AbstractController{

    #[Route(path: "/subscribtions", name: "subscribtions")]
    public function subscriptions(SubscriptionRepository $subscriptionRepository): Response{
        $user = $this->getUser();
        $subscription_offers = $subscriptionRepository->findAll();
        return $this->render("other/abonnements.html.twig", [
            "logged_user" => $user, 
            "subscription_offers" => $subscription_offers
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route(path: '/settings', name: 'settings')]
    public function settings(): Response{
        $user = $this->getUser();
        return $this->render("other/settings.html.twig", ["logged_user" => $user]);
    }
}