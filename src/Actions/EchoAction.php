<?php

namespace PhpBundle\TelegramClient\Actions;

use App\Core\Entities\RequestEntity;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Base\BaseAction2;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class EchoAction extends BaseAction2
{

    public function run(RequestEntity $requestEntity)
    {
        $this->response->sendMessage($requestEntity->getMessage()->getChat()->getId(), $requestEntity->getMessage()->getText());
    }

}