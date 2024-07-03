<?php

namespace App\Controller;

use App\Repository\PlayersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlayersController extends AbstractController
{
    #[Route('/players', name: 'app_players')]
    public function index(PlayersRepository $playerRepository): Response
    {
        $players = $playerRepository->findAll(); // Récupère tous les joueurs

        return $this->render('players/index.html.twig', [
            'players' => $players, // Passe les joueurs à la vue
        ]);
    }
}
