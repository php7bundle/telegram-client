<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;
use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class GroupAction extends BaseAction
{

    /** @var array | BaseAction[] */
    private $actions;

    public function __construct(array $actions)
    {
        parent::__construct();
        $this->actions = $actions;
    }

    public function run(MessageEntity $messageEntity)
    {
        foreach ($this->actions as $actionInstance) {
            yield $actionInstance->run($messageEntity);
        }
    }

}
