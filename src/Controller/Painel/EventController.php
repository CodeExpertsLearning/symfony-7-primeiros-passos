<?php

namespace App\Controller\Painel;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/painel/events', name: 'painel_events_')]
final class EventController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EventRepository $repository): Response
    {
        $events = $repository->findAll();

        return $this->render(
            'painel/events/index.twig',
            compact('events')
        );
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $event = $form->getData();

            $event->setCreatedAt();
            $event->setUpdatedAt();

            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute(
                'painel_events_edit',
                ['event' => $event->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render(
            'painel/events/create.twig',
            compact('form')
        );
    }

    #[Route('/edit/{event}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        int $event,
        Request $request,
        EventRepository $repository,
        EntityManagerInterface $em
        )
    {
        $event = $repository->find($event);

        if(!$event)
            throw $this->createNotFoundException();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $event = $form->getData();
            $event->setUpdatedAt();

            $em->flush();

            return $this->redirectToRoute(
                'painel_events_edit',
                ['event' => $event->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render(
            'painel/events/edit.twig',
            compact('form')
        );
    }

    #[Route('/remove/{event}', name: 'remove', methods: 'POST')]
    public function remove(
        int $event,
        Request $request,
        EventRepository $repository,
        EntityManagerInterface $em
        )
    {
        $event = $repository->find($event);

        if(!$event)
            throw $this->createNotFoundException();

        if(!$this->isCsrfTokenValid('delete'.$event->getId(), $request->getPayload()->get('_token')))
            throw $this->createAccessDeniedException();

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('painel_events_index');;
    }

    #[Route('/{event}', name: '_show')]
    public function show(int $event): JsonResponse
    {
        return $this->json([
            'params' => $event,
        ]);
    }
}
