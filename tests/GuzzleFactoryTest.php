<?php

namespace CanalTP\AbstractGuzzle\Tests;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;

class GuzzleFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $sandboxToken = '3b036afe-0110-4202-b9ed-99718476c2e0';

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createClient($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testAddAuthOptionAtConstruct()
    {
        $client = GuzzleFactory::createClient('https://api.navitia.io/v1/coverage/sandbox/', ['auth' => [$this->sandboxToken, null, 'basic']]);

        $this->assertEquals([$this->sandboxToken, null, 'basic'], $client->getDefaultOptions()['auth']);
    }

    public function testAddAuthOptionAfterInit()
    {
        $client = GuzzleFactory::createClient('https://api.navitia.io/v1/coverage/sandbox/');
        $client->setDefaultAuth($this->sandboxToken, null);

        $this->assertEquals([$this->sandboxToken, null, 'basic'], $client->getDefaultOptions()['auth']);
    }

    public function testGetMock()
    {
        $clientMock = GuzzleFactory::createClientMock([
            new Response(200, ['content-type' => 'application/json', 'content-length' => 26, 'canaltp' => 42]),
            new Response(200, [], '{"lines":"expected-lines"}'),
            new Response(404, ['Content-Length' => 0])
        ]);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $clientMock);

        $firstCall = $clientMock->send(new Request('get', 'github'));
        $firstCallHeaders = $firstCall->getHeaders();
        $this->assertInstanceOf('GuzzleHttp\\Psr7\\Response', $firstCall);
        $this->assertEquals(200, $firstCall->getStatusCode());
        $this->assertEquals(42, $firstCallHeaders['canaltp'][0]);
        $this->assertEquals('application/json', $firstCallHeaders['content-type'][0]);

        $secondCall = $clientMock->send(new Request('post', 'packagist'));
        $this->assertEquals('{"lines":"expected-lines"}', $secondCall->getBody()->getContents());

        // since guzzle 6, exception will be throw in case of http errors
        try {
            $thirdCall = $clientMock->send(new Request('get', 'php/404'));
            $this->assertEquals(404, $thirdCall->getStatusCode());
        } catch (ClientException $e) {
            $this->assertEquals(404, $e->getResponse()->getStatusCode());
        }
    }
}
