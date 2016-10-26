<?php

namespace CanalTP\AbstractGuzzle\Version;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use CanalTP\AbstractGuzzle\Guzzle;

class Guzzle6 extends Guzzle
{
    /**
     * @var Client
     */
    private $client;

    /**
     * {@InheritDoc}
     */
    public function __construct($baseUri, $options)
    {
        parent::__construct($baseUri);

        $this->initClient($options);
    }

    /**
     * Init Guzzle6 client with base url.
     */
    public function initClient($options)
    {

        $client = new Client(array_merge(
            ['base_uri' => $this->getBaseUri()],
            $options
        ));

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
        return $this->client->send($request);
    }
}
