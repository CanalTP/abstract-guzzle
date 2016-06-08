<?php

namespace CanalTP\AbstractGuzzle\Exception;

class UnsupportedException extends \LogicException
{
    public function __construct($previous = null)
    {
        parent::__construct(
            'Guzzle is either not installed or version is not supported.',
            0,
            $previous
        );
    }
}
