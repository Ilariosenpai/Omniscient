<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JoinusController extends AbstractController
{
    #[Route('/joinus', name: 'app_joinus')]
    public function index(UserRepository $userRepository): Response
    {
        $users= $userRepository->rankUserByAmoutDonated();

        return $this->render('joinus/index.html.twig', [
            'users' => $users,

        ]);
    }

    #[Route('/joinus/stripe/{price}', name: 'app_joinus_stripe')]
    public function submit(int $price): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

        /**
         * @var User $user
         */
        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'donnation',
                    ],
                    'unit_amount' => $price* 100, // Convertir le prix en cents
                    
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'success/' . $price,
            'cancel_url' => $YOUR_DOMAIN . 'cancel',

        ]);

        return $this->redirect($checkout_session->url, 303);
       
    }

    #[Route('/success/{price}', name: 'app_joinus_success')]
    public function success(int $price, EntityManagerInterface $entityManager): Response

    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        /**
         * @var User $user
         */

        $user->getAmoutDonated();
        $user->setAmoutDonated($user->getAmoutDonated() + $price);
        $entityManager->flush();

        return $this->render('joinus/success.html.twig', [
            'controller_name' => 'JoinusController',
        ]);
    }
    #[Route('/cancel', name: 'app_joinus_cancel')]
    public function cancel(): Response
    {
        return $this->render('joinus/cancel.html.twig', [
            'controller_name' => 'JoinusController',
        ]);
    }
}
