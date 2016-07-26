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
     * @param string $baseUri
     */
    public function __construct($baseUri)
    {
        $this->baseUri = $baseUri;
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

    /**
     * @param string $method
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function call($method, $uri, $headers = array(), $body = null)
    {
        $request = new Request($method, $uri, $headers, $body);

        $response = $this->send($request);

        return $response;
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function get($uri, $headers = array(), $body = null)
    {
        return $this->call('get', $uri, $headers, $body);
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function post($uri, $headers = array(), $body = null)
    {
        return $this->call('post', $uri, $headers, $body);
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function put($uri, $headers = array(), $body = null)
    {
        return $this->call('put', $uri, $headers, $body);
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function patch($uri, $headers = array(), $body = null)
    {
        return $this->call('patch', $uri, $headers, $body);
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function delete($uri, $headers = array(), $body = null)
    {
        return $this->call('delete', $uri, $headers, $body);
    }

    /**
     * @param string $uri
     * @param string[] $headers
     * @param string $body
     *
     * @return Response
     */
    public function head($uri, $headers = array(), $body = null)
    {
        return $this->call('head', $uri, $headers, $body);
    }
}
