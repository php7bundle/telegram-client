<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;
use danog\MadelineProto\APIFactory;

class GroupAction extends BaseAction
{

    /** @var array | BaseAction[] */
    private $actions;

    public function __construct(APIFactory $messages, array $actions)
    {
        parent::__construct($messages);
        $this->actions = $actions;
    }

    public function run($update)
    {
        foreach ($this->actions as $actionInstance) {
            yield $actionInstance->run($update);
        }
    }

}
