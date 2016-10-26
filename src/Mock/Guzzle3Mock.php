<?php

namespace CanalTP\AbstractGuzzle\Mock;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use Guzzle\Plugin\Mock\MockPlugin;

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
            $plugin->addResponse($response);
        }

        $client = GuzzleFactory::createGuzzle('');
        $client->addSubscriber($plugin);

        return $client;
    }
}
