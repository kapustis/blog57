<?php


namespace App\DesignPatterns\Fundamental\Delegation;


use App\DesignPatterns\Fundamental\Delegation\Interfaces\MessengerInterface;
use App\DesignPatterns\Fundamental\Delegation\Messengers\EmailMessenger;
use App\DesignPatterns\Fundamental\Delegation\Messengers\SmsMessenger;

class AppMessenger implements Interfaces\MessengerInterface
{
    /** @var MessengerInterface */
    private $messenger;

    public function __construct()
    {
        $this->toEmail();
    }


    /**
     * @return $this
     */
    public function toEmail()
    {
        $this->messenger = new EmailMessenger();

        return $this;
    }

    /**
     * @return $this
     */
    public function toSms(){
        $this->messenger = new SmsMessenger();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSender(string $value): MessengerInterface
    {
        $this->messenger->setSender($value);

        return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function serRecipient(string $value): MessengerInterface
    {
        $this->messenger->serRecipient($value);

        return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $value): MessengerInterface
    {
       $this->messenger->serRecipient($value);

       return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        return $this->messenger->send();
    }
}
