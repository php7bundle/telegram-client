<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Handlers\BaseInputMessageEventHandler;

class HelpAction extends BaseAction
{

    /** @var BaseInputMessageEventHandler */
    public $eventHandler;

    public function __construct(APIFactory $messages, BaseInputMessageEventHandler $eventHandler)
    {
        parent::__construct($messages);
        $this->eventHandler = $eventHandler;
    }

    public function run($update)
    {
        $definitions = $this->eventHandler->definitions();
        $lines = [];
        foreach ($definitions as $definition) {
            if(!empty($definition['help'])) {
                $lines[] = trim($definition['help']);
            }
        }
        return $this->messages->sendMessage([
            'peer' => $update,
            'message' => implode(PHP_EOL . PHP_EOL, $lines),
        ]);
    }

}