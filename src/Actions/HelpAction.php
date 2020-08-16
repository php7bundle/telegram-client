<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;
use PhpBundle\TelegramClient\Handlers\BaseInputMessageEventHandler;
use PhpLab\Core\Legacy\Yii\Helpers\ArrayHelper;

class HelpAction extends BaseAction
{

    /** @var BaseInputMessageEventHandler */
    public $eventHandler;

    public function __construct(/*BaseInputMessageEventHandler*/ $eventHandler)
    {
        parent::__construct();
        $this->eventHandler = $eventHandler;
    }

    public function run(MessageEntity $messageEntity)
    {
        $definitions = $this->eventHandler->definitions($this->response->getApi());
        $lines = [];
        foreach ($definitions as $definition) {
            if(!empty($definition['help'])) {
                $help = ArrayHelper::toArray($definition['help']);
                $lines[] = implode(PHP_EOL, $help);
            }
        }
        return $this->response->sendMessage(implode(PHP_EOL . PHP_EOL, $lines), $messageEntity->getUserId());
    }

}