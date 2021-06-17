<?php

namespace App\EventSubscriber\Dashboard;

use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordHandlerSubscriber implements EventSubscriberInterface {

    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Request
     */
    private $request;

    /**
     * UserPasswordHandlerSubscriber constructor.
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserRepository $userRepository
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher, UserRepository $userRepository, RequestStack $requestStack)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userRepository = $userRepository;
        $this->request = $requestStack->getCurrentRequest();
    }

    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityUpdatedEvent::class => ['setUserPassword']
        ];
    }

    public function setUserPassword(BeforeEntityUpdatedEvent $event)
    {
        $user = $event->getEntityInstance();
        if(!($user instanceof User)) return;

        if( strlen($user->getPassword()) < 60 ){
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
        }

    }
}