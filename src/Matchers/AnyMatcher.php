<?php

namespace PhpBundle\TelegramClient\Matchers;

use PhpBundle\TelegramClient\Interfaces\MatcherInterface;

class AnyMatcher implements MatcherInterface
{

    public function isMatch(array $update): bool
    {
        return true;
    }

}