<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JoinusController extends AbstractController
{
    #[Route('/joinus', name: 'app_joinus')]
    public function index(): Response
    {
        return $this->render('joinus/index.html.twig', [
            'controller_name' => 'JoinusController',
        ]);
    }
}
