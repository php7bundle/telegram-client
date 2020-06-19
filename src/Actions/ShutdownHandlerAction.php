<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\EventHandler;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class ShutdownHandlerAction extends BaseAction
{

    private $eventHandler;

    public function __construct(EventHandler $eventHandler)
    {
        parent::__construct($messages);
        $this->eventHandler = $eventHandler;
    }

    public function run(MessageEntity $messageEntity)
    {
        $this->eventHandler->stop();
    }

}