<?php

namespace PhpBundle\TelegramClient\Interfaces;

interface MatcherInterface
{

    public function isMatch(array $update): bool;

}