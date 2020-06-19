<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;

class SendMessageAction extends BaseAction
{

    private $text;

    public function __construct(string $text)
    {
        parent::__construct();
        $this->text = $text;
    }

    public function run(MessageEntity $messageEntity)
    {
        return $this->response->sendMessage($this->text);
        /*return $this->messages->sendMessage([
            'peer' => $update,
            'message' => $this->text,
            //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);*/
    }

}