<?php
declare(strict_types=1);

namespace WernerDweight\ScheduledMessengerBundle\Service;

use Symfony\Component\Messenger\MessageBusInterface;
use WernerDweight\RA\RA;

class ScheduledMessenger
{
    private $messageBus;

    private $messages;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messages = new RA();
        $this->messageBus = $messageBus;
    }
}
