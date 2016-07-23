<?php

namespace CanalTP\AbstractGuzzle;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

abstract class Guzzle
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * @param string $baseUrl
     */
    public function __construct($config)
    {
        if (!empty($config['base_uri'])) {
            $this->baseUri = $config['base_uri'];
        }
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     *
     * @return self
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    abstract public function send(Request $request);
}
