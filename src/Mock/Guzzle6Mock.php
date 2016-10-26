<?php

namespace CanalTP\AbstractGuzzle\Mock;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class Guzzle6Mock
{
    /**
     * Guzzle6Mock .
     *
     * @param array $responseCollection new Response(200, ['X-Foo' => 'Bar']),
     * new Response(202, ['Content-Length' => 0]),
     * new RequestException("Error Communicating with Server", new Request('GET', 'test'))
     * @return \CanalTP\AbstractGuzzle\Guzzle
     */
    public function getMock(array $responseCollection)
    {
        $mock = new MockHandler($responseCollection);
        $handler = HandlerStack::create($mock);

        return GuzzleFactory::createGuzzle('', ['handler' => $handler]);
    }
}
