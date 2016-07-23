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
     * @var defaultConfig
     */
    private $config;

    /**
     * {@InheritDoc}
     */
    /**
     * Guzzle6 accept an array of constructor parameters.
     *
     * Here's an example of creating a client using a base_uri and an array of
     * default request options to apply to each request:
     *
     *     $client = new Client([
     *         'base_uri'        => 'http://www.foo.com/1.0/',
     *         'timeout'         => 0,
     *         'allow_redirects' => false,
     *         'proxy'           => '192.168.16.1:10',
     *         'auth' => ['user', 'password']
     *     ]);
     * @param array $config
     */
    public function __construct($config)
    {
        parent::__construct($config);

        $this->config = $config;
        $this->setClient(new Client($config));
    }

    /**
     * @return defaultConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param defaultConfig $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
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
     * @param Request $request
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send(Request $request)
    {
        return $this->client->send($request);
    }

    /**
     * allow to use client's magic method
     *
     * @param $method
     * @param $args
     */
    public function __call($method, $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = isset($args[1]) ? $args[1] : [];

        return $this->client->$method($uri, $opts);
    }
}
