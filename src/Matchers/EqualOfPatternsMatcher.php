<?php

namespace PhpBundle\TelegramClient\Matchers;

use PhpBundle\TelegramClient\Helpers\MatchHelper;
use PhpBundle\TelegramClient\Interfaces\MatcherInterface;

class EqualOfPatternsMatcher implements MatcherInterface
{

    private $patterns;

    public function __construct(array $patterns)
    {
        $this->patterns = $patterns;
    }

    public function isMatch(array $update): bool
    {
        $message = $update['message']['message'];
        foreach ($this->patterns as $pattern) {
            if(MatchHelper::isMatchText($message, $pattern)) {
                return true;
            }
        }
        return false;
    }

}