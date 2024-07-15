<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news_index')]
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findAll();

        return $this->render('news/index.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/news/{id}', name: 'news_show')]
    public function show(int $id, NewsRepository $newsRepository): Response
    {
        $new = $newsRepository->find($id);

        if (!$new) {
            throw $this->createNotFoundException('The news does not exist');
        }

        return $this->render('news/show.html.twig', [
            'new' => $new,
        ]);
    }
}