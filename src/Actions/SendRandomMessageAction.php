<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;

class SendRandomMessageAction extends BaseAction
{

    private $responseList;

    public function __construct(APIFactory $messages, array $responseList)
    {
        parent::__construct($messages);
        $this->responseList = $responseList;
    }

    public function run($update)
    {
        $count = count($this->responseList);
        $randIndex = mt_rand(0, $count - 1);
        return $this->messages->sendMessage([
            'peer' => $update,
            'message' => $this->responseList[$randIndex],
            //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);
    }

}