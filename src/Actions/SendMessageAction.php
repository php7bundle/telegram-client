<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;

class SendMessageAction extends BaseAction
{

    private $text;

    public function __construct(APIFactory $messages, string $text)
    {
        parent::__construct($messages);
        $this->text = $text;
    }

    public function run($update)
    {
        return $this->messages->sendMessage([
            'peer' => $update,
            'message' => $this->text,
            //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);
    }

}