<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;
use PhpBundle\TelegramClient\Entities\ResponseEntity;

class SendGeoAction extends BaseAction
{

    public function __construct($long, $lat)
    {
        parent::__construct();
    }

    public function run(MessageEntity $messageEntity)
    {
        $longStr = '73.10441998' . mt_rand(1000, 9999);
        $latStr = '49.80095066' . mt_rand(1000, 9999);
        $responseEntity = new ResponseEntity;
        $responseEntity->setUserId($messageEntity->getUserId());
        $responseEntity->setMedia([
            '_' => 'inputMediaGeoPoint',
            'geo_point' => [
                '_' => 'inputGeoPoint',
                'long' => $longStr,
                'lat' => $latStr,
            ],
        ]);
        $responseEntity->setMethod('sendMedia');
        $responseEntity->setReplyMessageId($messageEntity->getId());
        return $this->response->send($responseEntity);
    }

}