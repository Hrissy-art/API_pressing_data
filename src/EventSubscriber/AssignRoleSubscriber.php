<?php
namespace App\EventSubscriber;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AssignRoleSubscriber implements EventSubscriberInterface
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // Assign role only if the entity being persisted is a User
        if ($entity instanceof Client) {
            // Assign the 'ROLE_CLIENT' role to the user
            $entity->setRoles(['ROLE_CLIENT']);
        }
    }

    public function getSubscribedEvents()
    {
        return [
            'prePersist',
        ];
    }
}

