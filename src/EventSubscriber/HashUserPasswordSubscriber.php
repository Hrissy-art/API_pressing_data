<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class HashUserPasswordSubscriber implements EventSubscriberInterface 
{
  public function __construct(private UserPasswordHasherInterface $hasher){

  }
  public function prePersist(PrePersistEventArgs $args):void
  {
    $object = $args->getObject();
    if(!$object instanceof User ) {
      return;
    }
    $userPassword = $object->getPassword();

    $object->setPassword(
      $this->hasher->hashPassword(
      $object,
      $userPassword));
  }
  public function getSubscribedEvents()
  {
    return [
      Events:: prePersist
    ];
  }
}