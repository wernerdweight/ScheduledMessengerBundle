<?php
declare(strict_types=1);

namespace WernerDweight\ScheduledMessengerBundle\Service;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;
use WernerDweight\RA\RA;

class ScheduledMessenger
{
    /** @var MessageBusInterface */
    private $messageBus;

    /** @var RA */
    private $messages;

    /**
     * ScheduledMessenger constructor.
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messages = new RA([
            KernelEvents::CONTROLLER => new RA(),
            KernelEvents::EXCEPTION => new RA(),
            KernelEvents::FINISH_REQUEST => new RA(),
            KernelEvents::REQUEST => new RA(),
            KernelEvents::RESPONSE => new RA(),
            KernelEvents::TERMINATE => new RA(),
            KernelEvents::VIEW => new RA(),
        ]);
        $this->messageBus = $messageBus;
    }

    /**
     * @param string $event
     * @param callable $callback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    private function dispatchOn(string $event, callable $callback): self
    {
        $this->messages->getRA($event)->push($callback);
        return $this;
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnController(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::CONTROLLER, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnException(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::EXCEPTION, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnFinishRequest(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::FINISH_REQUEST, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnRequest(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::REQUEST, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnResponse(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::RESPONSE, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnTerminate(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::TERMINATE, $messageCallback);
    }

    /**
     * @param callable $messageCallback
     * @return ScheduledMessenger
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function dispatchOnView(callable $messageCallback): self
    {
        return $this->dispatchOn(KernelEvents::VIEW, $messageCallback);
    }

    /**
     * @param string $event
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    private function flush(string $event): RA
    {
        $dispatchedMessages = new RA();
        $callbacks = $this->messages->getRA($event);
        while ($callback = $callbacks->pop()) {
            $message = $callback();
            $this->messageBus->dispatch($message);
            $dispatchedMessages->push($message);
        }
        return $dispatchedMessages;
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushController(): RA
    {
        return $this->flush(KernelEvents::CONTROLLER);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushException(): RA
    {
        return $this->flush(KernelEvents::EXCEPTION);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushFinishRequest(): RA
    {
        return $this->flush(KernelEvents::FINISH_REQUEST);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushRequest(): RA
    {
        return $this->flush(KernelEvents::REQUEST);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushResponse(): RA
    {
        return $this->flush(KernelEvents::RESPONSE);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushTerminate(): RA
    {
        return $this->flush(KernelEvents::TERMINATE);
    }

    /**
     * @return RA
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function flushView(): RA
    {
        return $this->flush(KernelEvents::VIEW);
    }
}
