<?php

namespace CanalTP\AbstractGuzzle\Mock;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use GuzzleHttp\Psr7\Response as Psr7Response;

class Guzzle3Mock
{
    /**
     * @param array $responseCollection
     * @return \CanalTP\AbstractGuzzle\Guzzle
     */
    public function getMock(array $responseCollection)
    {
        $plugin = new MockPlugin();
        foreach ($responseCollection as $response) {
            if ($response instanceof Psr7Response) {
                $response = new Response($response->getStatusCode(), $response->getHeaders(), $response->getBody());
            }
            $plugin->addResponse($response);
        }

        $client = GuzzleFactory::createClient('');
        $client->addSubscriber($plugin);

        return $client;
    }
}
