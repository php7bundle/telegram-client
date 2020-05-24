<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;

class SaveDraftAction extends BaseAction
{

    private $text;

    public function __construct(APIFactory $messages, string $text)
    {
        parent::__construct($messages);
        $this->text = $text;
    }

    public function run($update)
    {
        return $this->messages->saveDraft([
            'peer' => $update,
            'message' => $this->text,
        ]);
    }

}