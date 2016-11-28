<?php

namespace CanalTP\AbstractGuzzle;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;

/**
 * Class Guzzle
 * @package CanalTP\AbstractGuzzle
 *
 * @method Client getClient()
 * @method Guzzle setClient(Client $client)
 */
abstract class Guzzle
{
    protected $defaultOptions;

    /**
     * Init Guzzle client with base url.
     *
     * @param $baseUri
     * @param array $option
     */
    abstract public function __construct($baseUri, $option = []);

    /**
     * @return string
     */
    abstract public function getBaseUri();

    /**
     * @param string $baseUri
     *
     * @return self
     */
    abstract public function setBaseUri($baseUri);

    abstract public function setDefaultOptions($options = []);

    abstract public function getDefaultOptions();

    /**
     * This is a shortcut to set auth headers and allow you to be client version proof
     *
     * @param string $username
     * @param string $password
     * @param string $type
     * @return mixed
     */
    abstract public function setDefaultAuth($username, $password, $type);

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

        return $this->send($request);
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
