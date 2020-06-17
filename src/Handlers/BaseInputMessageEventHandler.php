<?php

namespace PhpBundle\TelegramClient\Handlers;

use PhpBundle\TelegramClient\Base\BaseAction;
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
        if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
            return;
        }
        try {
            yield $this->handleMessage($update);
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
    private function handleMessage($update)
    {
        $assoc = $this->definitions();
        foreach ($assoc as $item) {
            /** @var MatcherInterface $matcherInstance */
            $matcherInstance = $item['matcher'];
            /** @var BaseAction $actionInstance */
            $actionInstance = $item['action'];
            if ($matcherInstance->isMatch($update)) {
                $this->humanizeResponseDelay($update);
                return $actionInstance->run($update);
            }
        }
        return null;
    }

    private function humanizeResponseDelay($update)
    {
        if ($_ENV['APP_ENV'] == 'prod') {
            $seconds = mt_rand($_ENV['HUMANIZE_RESPONSE_DELAY_MIN'] ?? 1, $_ENV['HUMANIZE_RESPONSE_DELAY_MAX'] ?? 4);
            sleep($seconds);
        }
    }

}
