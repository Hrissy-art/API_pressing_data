<?php
namespace App\EventSubscriber;


use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AssignRoleAndOrderNumberSubscriber implements EventSubscriberInterface
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $entityManager = $args->getEntityManager();

  

        if ($entity instanceof Order) {
          $latestOrder = $entityManager->getRepository(Order::class)->findOneBy([], ['id' => 'DESC']);
          $latestOrderNumber = $latestOrder ? $latestOrder->getNumberOrder() : 0;
          $newOrderNumber = $latestOrderNumber + 1;
          $entity->setNumberOrder($newOrderNumber);

          
          $currentDate = new \DateTime(); 
          $entity->setDateRender($currentDate);
      }
  }

  public function getSubscribedEvents()
  {
      return [
          'prePersist',
      ];
  }}

