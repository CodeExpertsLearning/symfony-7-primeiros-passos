<?php

namespace App\Factory;

use App\Entity\Event;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Event>
 */
final class EventFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Event::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $dateNow = new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        return [
            'title' => self::faker()->text(65),
            'body' => self::faker()->paragraphs(3, asText: true),
            'description' => self::faker()->sentence,
            'slug' => self::faker()->unique()->slug(),
            'startEvent' => self::faker()->dateTime(),
            'endEvent' => self::faker()->dateTime(),
            'createdAt' => $dateNow,
            'updatedAt' => $dateNow,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Event $event): void {})
        ;
    }
}
