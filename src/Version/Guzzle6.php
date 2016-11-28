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
    public function __construct($baseUri, $options = [])
    {
        $this->defaultOptions = array_merge([
            'base_uri' => $baseUri,
            'http_errors' => false
        ], $options);

        $this->client = new Client($this->defaultOptions);
    }

    public function setBaseUri($baseUri)
    {
        $this->setDefaultOptions(array_merge($this->defaultOptions, ['base_uri' => $baseUri]));
    }

    public function getBaseUri()
    {
        return $this->client->getConfig('base_uri');
    }

    public function setDefaultOptions($options = [])
    {
        $this->__construct($this->getBaseUri(), $options);
    }

    public function getDefaultOptions()
    {
        return $this->client->getConfig();
    }

    public function setDefaultAuth($username, $password, $type = 'basic')
    {
        $auth = [$username, $password];
        if ($type !== 'basic') {
            $auth[] = $type;
        }

        $this->setDefaultAuth('auth', $auth);
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
