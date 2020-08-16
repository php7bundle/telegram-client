<?php

namespace PhpBundle\TelegramClient\Matchers;

use App\Core\Entities\RequestEntity;
use PhpBundle\TelegramClient\Interfaces\MatcherInterface;

class AnyMatcher implements MatcherInterface
{

    public function isMatch(RequestEntity $requestEntity): bool
    {
        return true;
    }

}