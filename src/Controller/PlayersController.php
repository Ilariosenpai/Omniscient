<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlayersController extends AbstractController
{
    #[Route('/players', name: 'app_players')]
    public function index(): Response
    {
        return $this->render('players/index.html.twig', [
            'controller_name' => 'PlayersController',
        ]);
    }
}
