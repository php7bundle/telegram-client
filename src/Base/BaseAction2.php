<?php

namespace PhpBundle\TelegramClient\Base;

use App\Core\Entities\RequestEntity;
use App\Core\Services\ResponseService;
use PhpBundle\TelegramClient\Services\SessionService;
use PhpBundle\TelegramClient\Services\StateService;
use PhpBundle\TelegramClient\Services\UserService;
use danog\MadelineProto\APIFactory;
use danog\MadelineProto\messages;
use Illuminate\Container\Container;
use PhpBundle\TelegramClient\Entities\MessageEntity;

abstract class BaseAction2
{

    /** @var SessionService */
    protected $session;

    /** @var StateService */
    protected $state;

    /** @var ResponseService */
    protected $response;

    public function __construct()
    {
        $container = Container::getInstance();
        //$this->session = $container->get(SessionService::class);
        //$this->state = $container->get(StateService::class);
        /** @var ResponseService $response */
        $this->response = $container->get(ResponseService::class);
        //$this->response = new ResponseService($messages, $container->get(UserService::class));
    }

    public function stateName() {
        return null;
    }

    abstract public function run(RequestEntity $requestEntity);

}
