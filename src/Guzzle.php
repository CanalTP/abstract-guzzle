<?php

namespace CanalTP\AbstractGuzzle;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

abstract class Guzzle
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     *
     * @return self
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    abstract public function send(Request $request);
}
