<?php

namespace PhpBundle\TelegramClient\Matchers;

use App\Core\Entities\RequestEntity;
use PhpBundle\TelegramClient\Helpers\MatchHelper;
use PhpBundle\TelegramClient\Interfaces\MatcherInterface;

class EqualOfPatternsMatcher implements MatcherInterface
{

    private $patterns;

    public function __construct(array $patterns)
    {
        $this->patterns = $patterns;
    }

    public function isMatch(RequestEntity $requestEntity): bool
    {
        $message = $requestEntity->getMessage()->getText();
        foreach ($this->patterns as $pattern) {
            if(MatchHelper::isMatchText($message, $pattern)) {
                return true;
            }
        }
        return false;
    }

}