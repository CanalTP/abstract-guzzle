<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class Guzzle3Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (3 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 3 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedSpecificInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url-for3.tld';
        $guzzle = GuzzleFactory::createClient($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle3', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
    
    public function testClientMockForVersion3()
    {
        $clientMock = GuzzleFactory::createClientMock([]);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle3', $clientMock);
    }
}
