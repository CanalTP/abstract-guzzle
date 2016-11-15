<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;

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
        $guzzle = GuzzleFactory::createClient($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle5', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testClientMockForVersion5()
    {
        $clientMock = GuzzleFactory::createClientMock([]);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle5', $clientMock);
    }
}
