<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;

class TypingAction extends BaseAction
{

    public function run($update)
    {
        return $this->messages->setTyping([
            'peer' => $update,
            'action' => [
                '_' => 'SendMessageAction',
                'action' => 'updateUserTyping',
                'user_id' => $update['message']['from_id'],
            ],
        ]);
    }

}