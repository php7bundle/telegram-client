<?php

namespace PhpBundle\TelegramClient\Base;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\messages;

abstract class BaseAction
{

    /** @var messages */
    protected $messages;

    public function __construct(APIFactory $messages)
    {
        $this->messages = $messages;
    }

    abstract public function run($update);

}
