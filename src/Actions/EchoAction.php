<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class EchoAction extends BaseAction
{

    public function run(MessageEntity $messageEntity)
    {
        return $this->response->sendMessage(json_encode($messageEntity, JSON_PRETTY_PRINT), $_ENV['ADMIN_LOGIN'], $messageEntity->getId());
    }

}