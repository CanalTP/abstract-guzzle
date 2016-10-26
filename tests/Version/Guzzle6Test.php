<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Psr7\Response;
use CanalTP\AbstractGuzzle\Mock\Guzzle6Mock;

class Guzzle6Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (6 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 6 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedSpecificInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url-for6.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle6', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testMockedGuzzle()
    {
        $responseCollection = [
            new Response(200, ['body' => '{"lines":"expected-lines"}']),
            new Response(202, ['Content-Length' => 0])
        ];
        $mock = new Guzzle6Mock();
        $mockedGuzzle = $mock->getMock($responseCollection);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle6', $mockedGuzzle);
        $this->assertEquals($responseCollection[0], $mockedGuzzle->get('/impossibru'));
        $this->assertEquals($responseCollection[1], $mockedGuzzle->get('/frenchkiss'));
    }
}
