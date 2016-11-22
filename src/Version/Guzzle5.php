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
    public function __construct($baseUri, $options = [])
    {
        $this->defaultOptions = array_merge([
            'base_url' => $baseUri,
            'defaults' => [
                'exceptions' => false,
            ]
        ], $options);

        $this->client = new Client($this->defaultOptions);
    }

    /**
     * We have to recreate client to modify baseUri
     *
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->setDefaultOptions(array_merge($this->defaultOptions, ['base_url' => $baseUri]));
    }

    public function getBaseUri()
    {
        return $this->client->getBaseUrl();
    }

    public function setDefaultOptions($options = [])
    {
        $this->__construct($this->getBaseUri(), $options);
    }

    public function getDefaultOptions()
    {
        return $this->client->getDefaultOption();
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
            ['headers' => $request->getHeaders()]
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

    /**
     * Used to mock client
     *
     * @return \GuzzleHttp\Event\Emitter|\GuzzleHttp\Event\EmitterInterface
     */
    public function getEmitter()
    {
        return $this->client->getEmitter();
    }
}
