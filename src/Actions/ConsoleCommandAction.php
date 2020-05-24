<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\EventHandler;
use PhpBundle\TelegramClient\Base\BaseAction;

class ConsoleCommandAction extends BaseAction
{

    public function run($update)
    {
        $command = $update['message']['message'];
        $command = ltrim($command, ' ~');
        if(empty($command)) {
            return $this->messages->sendMessage([
                'peer' => $update,
                'message' => 'Empty',
                'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
            ]);
        }
        $result = shell_exec($command) ?? 'Completed!';
        return $this->messages->sendMessage([
            'peer' => $update,
            'message' => $result,
            'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);
    }

}