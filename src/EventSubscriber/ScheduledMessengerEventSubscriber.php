<?php
declare(strict_types=1);

namespace WernerDweight\ScheduledMessengerBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use WernerDweight\ScheduledMessengerBundle\Service\ScheduledMessenger;

final class ScheduledMessengerEventSubscriber implements EventSubscriberInterface
{
    /** @var ScheduledMessenger */
    private $scheduledMessenger;

    /**
     * ScheduledMessengerEventSubscriber constructor.
     *
     * @param ScheduledMessenger $scheduledMessenger
     */
    public function __construct(ScheduledMessenger $scheduledMessenger)
    {
        $this->scheduledMessenger = $scheduledMessenger;
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelController(): void
    {
        $this->scheduledMessenger->flushController();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelException(): void
    {
        $this->scheduledMessenger->flushException();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelFinishRequest(): void
    {
        $this->scheduledMessenger->flushFinishRequest();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelRequest(): void
    {
        $this->scheduledMessenger->flushRequest();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelResponse(): void
    {
        $this->scheduledMessenger->flushResponse();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelTerminate(): void
    {
        $this->scheduledMessenger->flushTerminate();
    }

    /**
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function onKernelView(): void
    {
        $this->scheduledMessenger->flushView();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => [
                ['onKernelController', 8],
            ],
            KernelEvents::EXCEPTION => [
                ['onKernelException', 8],
            ],
            KernelEvents::FINISH_REQUEST => [
                ['onKernelFinishRequest', 8],
            ],
            KernelEvents::REQUEST => [
                ['onKernelRequest', 8],
            ],
            KernelEvents::RESPONSE => [
                ['onKernelResponse', 8],
            ],
            KernelEvents::TERMINATE => [
                ['onKernelTerminate', 8],
            ],
            KernelEvents::VIEW => [
                ['onKernelView', 8],
            ],
        ];
    }
}
