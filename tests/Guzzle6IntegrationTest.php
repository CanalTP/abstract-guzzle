<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class Guzzle6IntregationTest extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (6 < GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test compatible for version 6');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUrl = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle(['base_uri' => $baseUrl]);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $guzzle);
        $this->assertEquals($baseUrl, $guzzle->getBaseUri());
    }

    public function testSimpleCall()
    {
        $baseUrl = 'https://api.navitia.io/v1/';
        $guzzle = GuzzleFactory::createGuzzle(['base_uri' => $baseUrl, 'auth' => ['3b036afe-0110-4202-b9ed-99718476c2e0', '']]);
        $response = $guzzle->get('coverage/sandbox');
        $this->assertInstanceOf('GuzzleHttp\Psr7\Response', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
