<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Factory\EventFactory;
use DateTimeZone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $start = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        // $end   = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

        // for($i = 1; $i <= 30; $i++) {

        //     $event = new Event();
        //     $event->setTitle('Evento ' . $i);
        //     $event->setDescription('Descrição Evento ' . $i);
        //     $event->setBody('Conteúdo Evento ' . $i);
        //     $event->setSlug('evento-' . $i);
        //     $event->setStartEvent($start);
        //     $event->setEndEvent($end);

        //     $event->setCreatedAt();
        //     $event->setUpdatedAt();

        //     $manager->persist($event);
        // }
        // $manager->flush();

        EventFactory::createMany(60);
    }
}
