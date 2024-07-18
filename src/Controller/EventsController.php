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

        // $slug = 'smash-ultimate';
        $tourneySlug = 'Omnistrike';
        $sponsor = 'OMNI';
        $query = <<<GRAPHQL
                
                       query PrefixSearchAttendees(\$tourneySlug:String!, \$sponsor: String!) {
                          tournament(slug: \$tourneySlug) {
                             id
                             name
                             participants(query: {
                                filter: {
                                   search: {
                                      fieldsToSearch: ["prefix"],
                                      searchString: \$sponsor
                                   }
                                }
                             }) {
                                nodes {
                                   id
                                   gamerTag
                                }
                             }
                          }
                       },
                     
                GRAPHQL;

        $variables = [
            'tourneySlug' => $tourneySlug,
            'sponsor' => $sponsor,
        ];

        $headers = [
            'Authorization' => 'Bearer c3ba932e04efad083df782b4de022b27'
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
