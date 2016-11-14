<?php

namespace CanalTP\AbstractGuzzle\Mock;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Psr7\Response as psr7Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Subscriber\Mock;

class Guzzle5Mock
{
    /**
     * @param Response[] $responseCollection
     * @return \CanalTP\AbstractGuzzle\Guzzle
     */
    public function getMock(array $responseCollection)
    {
        $version5ResponseCollection = [];
        $client = GuzzleFactory::createClient('');

        foreach ($responseCollection as $response) {
            if ($response instanceof Psr7Response) {
                $version5ResponseCollection[] = new Response(
                    $response->getStatusCode(),
                    $response->getHeaders(),
                    Stream::factory($response->getBody()->getContents())
                );
            } else {
                $version5ResponseCollection[] = new Response();
            }
        }
        $mock = new Mock($version5ResponseCollection);
        $client->getEmitter()->attach($mock);

        return $client;
    }
}
