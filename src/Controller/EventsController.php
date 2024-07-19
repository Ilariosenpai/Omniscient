<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EventsController extends AbstractController
{
    #[Route('/events', name: 'app_events')]
    public function index(HttpClientInterface $client): Response
    {

        
        $tourneySlug = 'Omnistrike';
        $query = <<<GRAPHQL
                        
            query TournamentsSearch(\$tourneySlug: String!) {
                tournaments(query: {
                    perPage: 4, 
                    filter: {
                        name: \$tourneySlug
                    }
                }) {
                    nodes {
                        id
                        name
                        slug
                        startAt
                        endAt
                    }
                }
            }
                             
        GRAPHQL;
        
        $variables = [
            'tourneySlug' => $tourneySlug,
        ];
        
        
        
       
        


        $headers = [
            'Authorization' => 'Bearer ' . $_ENV['API_STARTGG'],
        ];

        $response = $client->request('POST', 'https://api.start.gg/gql/alpha', [
            'headers' => $headers,
            'json' => [
                'query' => $query,
                'variables' => $variables,
            ],
        ]);

        $data = $response->toArray();

        return $this->render('events/index.html.twig', [
            'data' => $data,
            'controller_name' => 'EventsController',
        ]);
    }

}
