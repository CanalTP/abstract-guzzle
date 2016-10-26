<?php

namespace CanalTP\AbstractGuzzle\Mock;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Subscriber\Mock;

class Guzzle5Mock
{
    /**
     * @param array $responseCollection
     * @return \CanalTP\AbstractGuzzle\Guzzle
     */
    public function getMock(array $responseCollection)
    {
        $client = GuzzleFactory::createGuzzle('');
        $mock = new Mock($responseCollection);
        $client->getEmitter()->attach($mock);

        return $client;
    }
}
