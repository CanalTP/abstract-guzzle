<?php

namespace CanalTP\AbstractGuzzle\Version;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Client;
use CanalTP\AbstractGuzzle\Guzzle;

class Guzzle5 extends Guzzle
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@InheritDoc}
     */
    public function __construct($baseUri)
    {
        parent::__construct($baseUri);

        $this->initClient();
    }

    /**
     * Init Guzzle5 client with base url.
     */
    public function initClient()
    {
        $client = new Client(array(
            'base_url' => $this->getBaseUri(),
            'stream' => false,
            'http_errors' => false,
        ));

        $client->setDefaultOption('exceptions', false);

        $this->setClient($client);
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
            [
                'headers' => $request->getHeaders(),
            ]
        );

        $guzzleRequest->setBody(Stream::factory($request->getBody()));

        $guzzleResponse = $this->getClient()->send($guzzleRequest);

        $response = new Response(
            $guzzleResponse->getStatusCode(),
            $guzzleResponse->getHeaders(),
            $guzzleResponse->getBody(true)
        );

        return $response;
    }
}
