<?php

namespace PhpBundle\TelegramClient\Actions;

use danog\MadelineProto\APIFactory;
use PhpBundle\TelegramClient\Base\BaseAction;

class SendGeoAction extends BaseAction
{

    public function __construct(APIFactory $messages, $long, $lat)
    {
        parent::__construct($messages);
    }

    public function run($update)
    {
        $longStr = '73.10441998' . mt_rand(1000, 9999);
        $latStr = '49.80095066' . mt_rand(1000, 9999);
        return $this->messages->sendMedia([
            'peer' => $update,
            'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
            'media' => [
                '_' => 'inputMediaGeoPoint',
                'geo_point' => [
                    '_' => 'inputGeoPoint',
                    'long' => $longStr,
                    'lat' => $latStr,
                ],
            ],
        ]);
    }

}