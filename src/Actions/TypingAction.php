<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class TypingAction extends BaseAction
{

    public function run(MessageEntity $messageEntity)
    {
        /*return $this->messages->setTyping([
            'peer' => $messageEntity->getUserId(),
            'action' => [
                '_' => 'SendMessageAction',
                'action' => 'updateUserTyping',
                'user_id' => $update['message']['from_id'],
            ],
        ]);*/
    }

}