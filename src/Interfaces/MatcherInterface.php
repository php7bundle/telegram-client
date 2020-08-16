<?php

namespace PhpBundle\TelegramClient\Interfaces;

use App\Core\Entities\RequestEntity;

interface MatcherInterface
{

    public function isMatch(RequestEntity $requestEntity): bool;

}