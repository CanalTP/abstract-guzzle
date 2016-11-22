<?php

namespace CanalTP\AbstractGuzzle\Version;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Guzzle\Http\Client;
use CanalTP\AbstractGuzzle\Guzzle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Guzzle3 extends Guzzle
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@InheritDoc}
     */
    public function __construct($baseUri, $options = [])
    {
        $this->setClient(new Client($baseUri, [
            'request.options' => [
                'exceptions' => false,
                'stream' => false
            ]
        ]));
    }

    public function getBaseUri()
    {
        // TODO: Implement getBaseUri() method.
    }

    public function setBaseUri($baseUri)
    {
        // TODO: Implement setBaseUri() method.
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return self
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * {@InheritDoc}
     */
    public function send(Request $request)
    {
        $guzzleRequest = $this->client->createRequest(
            $request->getMethod(),
            $request->getUri(),
            $request->getHeaders(),
            $request->getBody()
        );

        $guzzleResponse = $guzzleRequest->send();

        $response = new Response(
            $guzzleResponse->getStatusCode(),
            $guzzleResponse->getHeaders()->toArray(),
            $guzzleResponse->getBody(true)
        );

        return $response;
    }

    /**
     * use to mock client
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->client->addSubscriber($subscriber);
    }
}
