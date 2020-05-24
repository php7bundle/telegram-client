<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\EventHandler;
use PhpBundle\TelegramClient\Base\BaseAction;

class ShutdownHandlerAction extends BaseAction
{

    private $eventHandler;

    public function __construct(APIFactory $messages, EventHandler $eventHandler)
    {
        parent::__construct($messages);
        $this->eventHandler = $eventHandler;
    }

    public function run($update)
    {
        $this->eventHandler->stop();
    }

}