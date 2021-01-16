<?php

namespace App\DesignPatterns\Fundamental\Delegation\Messengers;

use App\DesignPatterns\Fundamental\Delegation\Interfaces\MessengerInterface;

/**
 * Class AbstractMessenger
 *
 * @package App\DesignPatterns\Fundamental\Delegation\Messengers
 */
abstract class AbstractMessenger implements MessengerInterface
{
    /** @var string */
    protected $sender;
    /** @var string */
    protected $recipient;
    /** @var string */
    protected $message;

    /**
     * @inheritDoc
     */
    public function setSender(string $value): MessengerInterface
    {
        // TODO: Implement setSender() method.
        $this->sender = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function serRecipient(string $value): MessengerInterface
    {
        // TODO: Implement serRecipient() method.
        $this->recipient = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $value): MessengerInterface
    {
        // TODO: Implement setMessage() method.
        $this->message = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        // TODO: Implement send() method.
        return true;
    }
}
