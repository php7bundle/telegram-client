<?php

namespace PhpBundle\TelegramClient\Matchers;

use PhpBundle\TelegramClient\Interfaces\MatcherInterface;

class GroupAndMatcher implements MatcherInterface
{

    private $matchers;

    public function __construct(array $matchers)
    {
        $this->matchers = $matchers;
    }

    public function isMatch(array $update): bool
    {
        foreach ($this->matchers as $matcherInstance) {
            $isMatch = $matcherInstance->isMatch($update);
            if( ! $isMatch) {
                return false;
            }
        }
        return true;
    }

}