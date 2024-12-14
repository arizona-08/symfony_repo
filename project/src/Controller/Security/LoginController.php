<?php

namespace App\Controller\Security;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

// #[Route("/login")]
class LoginController extends AbstractController{
    // #[Route(path: '/login', name: "login")]
    // public function login(): Response
    // {
    //     //retourne la vue pour le login
    //     return $this->render("auth/login.html.twig");
    // }

    #[Route(path: '/confirm', name: "confirm")]
    public function confirm(): Response
    {
        //retourne la vue pour le confirm
        return $this->render("auth/confirm.html.twig");
    }

    #[Route(path: '/forgot', name: "forgot")]
    public function forgot(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {

        if($request->isMethod("POST")){
            $userEmail = $request->get('_email');
            $user = $userRepository->findOneByEmail($userEmail);

            if($user == null){
               $this->addFlash('userNotFound', "Aucun compte n'est associé à cet email");
               return $this->redirectToRoute("forgot");
            } else {
                $resetToken = Uuid::v7();
                $user->setResetToken($resetToken);
                $entityManager->flush($user);

                $email = (new TemplatedEmail())
                    ->from('streemi.team@example.com')
                    ->to(new Address($user->getEmail()))
                    ->subject('Réinitialisation de mot de passe')
                    ->htmlTemplate('email/reset.html.twig')
                    ->context([
                        'resetToken' => $resetToken
                    ]);

                $mailer->send($email);
            }
        }
        //retourne la vue pour le forgot
        return $this->render("auth/forgot.html.twig");
    }

    #[Route(path: '/reset/{token}', name: 'reset')]
    public function reset(string $token, Request $request, UserRepository $userRepository, UserPasswordHasherInterface  $hasher, EntityManagerInterface $entityManager): Response {

        $user = $userRepository->findOneByResetToken($token);

        if(!$user){
            return $this->render("auth/error-reset.html.twig");
        }

        if($request->isMethod('POST')){
            $password = $request->get('_password');
            $confirm = $request->get('_confirm');

            if($password == $confirm){
                $hashedPassword = $hasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                $entityManager->flush($user);

                return $this->redirectToRoute('app_login');
            }
        }
        return $this->render("auth/reset.html.twig");
    }
}