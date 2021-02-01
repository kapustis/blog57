<?php

namespace App\DesignPatterns\Fundamental\Delegation\Messengers;

class EmailMessenger extends AbstractMessenger
{
    public function send(): bool
    {
        \DebugBar::info('Sent by '.__METHOD__);
        return parent::send(); // TODO: Change the autogenerated stub
    }
}