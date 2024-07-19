<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AlbumRepository;
use App\Entity\Album;


class AlbumsController extends AbstractController
{
    #[Route('/albums', name: 'app_albums')]
    public function index(AlbumRepository $albumRepository): Response
    {
        $albums = $albumRepository->findAll();

        return $this->render('albums/index.html.twig', [
            'controller_name' => 'AlbumsController',
            'albums' => $albums,

        ]);
    }

    #[Route('/albums/{id}', name: 'albums_show')]
    public function show(int $id, AlbumRepository $albumRepository): Response
    {
        $album = $albumRepository->find($id);

        if (!$album) {
            throw $this->createNotFoundException('The album does not exist');
        }

        return $this->render('albums/show.html.twig', [
            'album' => $album,
        ]);
    }
}
