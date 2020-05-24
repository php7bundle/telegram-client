<?php

namespace PhpBundle\TelegramClient\Actions;

use PhpBundle\TelegramClient\Base\BaseAction;

class EchoAction extends BaseAction
{

    public function run($update)
    {
        return $this->messages->sendMessage([
            'peer' => $_ENV['ADMIN_LOGIN'],
            'message' => json_encode($update, JSON_PRETTY_PRINT),
            'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);
    }

}