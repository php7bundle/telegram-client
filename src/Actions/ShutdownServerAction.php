<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\EventHandler;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class ShutdownServerAction extends BaseAction
{

    private $eventHandler;

    public function __construct(EventHandler $eventHandler)
    {
        parent::__construct();
        $this->eventHandler = $eventHandler;
    }

    public function run(MessageEntity $messageEntity)
    {
        // powercfg /hibernate off
        //shell_exec('rundll32.exe powrprof.dll,SetSuspendState 0,1,0');
        shell_exec('Rundll32.exe powrprof.dll,SetSuspendState 0');
    }

}