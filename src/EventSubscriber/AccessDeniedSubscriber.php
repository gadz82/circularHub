<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class AccessDeniedSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    protected $security;

    public function __construct(Security $security, RouterInterface $router){
        $this->security = $security;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 2],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof AccessDeniedException) {
            return;
        }

        if($this->security->getUser() && $this->security->isGranted("ROLE_USER")){
            $url = $this->router->generate('blog_index');
            $response = new RedirectResponse($url);
            $event->setResponse($response);
            $event->stopPropagation();
        }

    }
}