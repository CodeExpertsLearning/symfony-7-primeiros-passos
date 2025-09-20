<?php

namespace App\Controller\Painel;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/painel/events', name: 'app_painel_event')]
final class EventController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@doe.com'
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@doe.com'
            ],
            [
                'name' => 'Fulano de Tal',
                'email' => 'fulano@tal.com'
            ]
        ];

        return $this->render(
            'painel/events/index.twig',
            compact('users')
        );
    }

    #[Route('/{event}', name: '_show')]
    public function show(int $event): JsonResponse
    {
        return $this->json([
            'params' => $event,
        ]);
    }
}
