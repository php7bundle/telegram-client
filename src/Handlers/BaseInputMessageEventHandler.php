<?php

namespace PhpBundle\TelegramClient\Handlers;

use PhpBundle\TelegramClient\Services\ResponseService;
use PhpBundle\TelegramClient\Services\SessionService;
use PhpBundle\TelegramClient\Services\StateService;
use PhpBundle\TelegramClient\Services\UserService;
use danog\MadelineProto\APIFactory;
use Illuminate\Container\Container;
use PhpBundle\TelegramClient\Base\BaseAction;
use PhpBundle\TelegramClient\Entities\MessageEntity;
use PhpBundle\TelegramClient\Entities\ResponseEntity;
use PhpBundle\TelegramClient\Interfaces\MatcherInterface;
use danog\MadelineProto\RPCErrorException;
use Exception;

abstract class BaseInputMessageEventHandler extends BaseEventHandler
{

    abstract public function definitions();

    /**
     * Handle updates from users.
     *
     * @param array $update Update
     *
     * @return \Generator
     */
    public function onUpdateNewMessage(array $update): \Generator
    {
        try {
            if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
                return;
            }
            yield $this->handleMessage($update, $this->messages);
        } catch (RPCErrorException $e) {
            $this->report("--report: Surfaced: $e");
        } catch (Exception $e) {
            if (\stripos($e->getMessage(), 'invalid constructor given') === false) {
                $this->report("--report: Surfaced: $e");
            }
        }
    }

    /**
     * @param $update
     * @return mixed
     */
    private function handleMessage($update, APIFactory $messages)
    {
        $this->auth($update);
        $action = $this->getStateFromSession();
        $this->prepareResponse($messages);
        $assoc = $this->definitions($messages);
        foreach ($assoc as $item) {
            $isActive = empty($item['state']) || ($item['state'] == '*' && !empty($action)) || ($item['state'] == $action);
            if($isActive) {
                /** @var MatcherInterface $matcherInstance */
                $matcherInstance = $item['matcher'];
                /** @var BaseAction $actionInstance */
                $actionInstance = $item['action'];
                if ($matcherInstance->isMatch($update)) {
                    $this->humanizeResponseDelay($update);

                    $messageEntity = new MessageEntity;
                    $messageEntity->setId($update['message']['id']);
                    $messageEntity->setUserId($update['message']['user_id'] ?: $update['message']['from_id']);
                    $messageEntity->setMessage($update['message']['message']);

                    //$messageId = isset($update['message']['id']) ? $update['message']['id'] : null;
                    //$userId = isset($update['message']['user_id']) ? $update['message']['user_id'] : null;

                    return $actionInstance->run($messageEntity);
                }
            }
        }
        return null;
    }

    private function prepareResponse(APIFactory $messages) {
        $container = Container::getInstance();
        /** @var ResponseService $response */
        $response = $container->get(ResponseService::class);
        $response->setApi($messages);
    }

    private function auth($update)
    {
        $container = Container::getInstance();
        //$messages = $this->messages;
        //$container->bind(APIFactory::class, function () {return $this->messages;}, true);
        /** @var UserService $userService */
        $userService = $container->get(UserService::class);
        if(!empty($update['message']['user_id'])) {
            $userService->authByUpdate($update);
        } else {
            $userService->logout();
        }
    }

    private function getStateFromSession() {
        $container = Container::getInstance();
        /** @var StateService $state */
        $state = $container->get(StateService::class);
        return $state->get();
    }

    private function humanizeResponseDelay($update)
    {
        if ($_ENV['APP_ENV'] == 'prod') {
            $seconds = mt_rand($_ENV['HUMANIZE_RESPONSE_DELAY_MIN'] ?? 1, $_ENV['HUMANIZE_RESPONSE_DELAY_MAX'] ?? 4);
            sleep($seconds);
        }
    }

}
