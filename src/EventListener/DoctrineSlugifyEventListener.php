<?php


namespace App\EventListener;


use App\Entity\Behavior\WithSlug;
use Cocur\Slugify\Slugify;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class DoctrineSlugifyEventListener implements EventSubscriber
{
    private $slugger;

    public function __construct()
    {
        $this->slugger = new Slugify();
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args) {
        $this->prePersist($args);
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getObject();

        if ($entity instanceof WithSlug) {
            $entity->slugify($this->slugger);
        }

    }
}