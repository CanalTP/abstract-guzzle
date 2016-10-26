<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use CanalTP\AbstractGuzzle\Mock\Guzzle5Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class Guzzle5Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (5 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 5 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedSpecificInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url-for5.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle5', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testMockedGuzzle()
    {
        $responseCollection = [
            new Response(200, ['content-type' => 'application/json', 'content-length' => 26, 'canaltp' => 42]),
        ];

        $mock = new Guzzle5Mock();
        $mockedGuzzle = $mock->getMock($responseCollection);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle5', $mockedGuzzle);

        // check that first call is mocked
        $firstCall = $mockedGuzzle->get('/impossibru');
        $firstCallHeaders = $firstCall->getHeaders();
        $this->assertEquals(200, $firstCall->getStatusCode());
        $this->assertEquals(42, $firstCallHeaders['canaltp'][0]);
    }
}
