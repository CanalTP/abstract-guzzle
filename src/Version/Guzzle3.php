<?php

namespace CanalTP\AbstractGuzzle\Version;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Guzzle\Http\Client;
use CanalTP\AbstractGuzzle\Guzzle;

class Guzzle3 extends Guzzle
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@InheritDoc}
     */
    public function __construct($baseUrl)
    {
        parent::__construct($baseUrl);

        $this->initClient();
    }

    /**
     * Init Guzzle3 client with base url.
     */
    public function initClient()
    {
        $this->setClient(new Client($this->getBaseUrl(), [
            'request.options' => [
                'exceptions' => false,
                'stream' => false
            ]
        ]));
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
}
