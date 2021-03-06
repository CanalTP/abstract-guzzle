<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;

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
        $guzzle = GuzzleFactory::createClient($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle6', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testGetBaseUri()
    {
        $guzzle = GuzzleFactory::createClient('http://fakebaseuri.com');

        $this->assertEquals($guzzle->getClient()->getConfig()['base_uri'], $guzzle->getBaseUri());
    }

    public function testSetBaseUri()
    {
        $guzzle = GuzzleFactory::createClient('http://fail-base-uri.no');
        $goodUri = 'http://realbaseuri.yes';
        $guzzle->setBaseUri($goodUri);

        $this->assertEquals($goodUri, $guzzle->getBaseUri());
    }

    public function testClientMockForVersion6()
    {
        $clientMock = GuzzleFactory::createClientMock([]);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle6', $clientMock);
    }
}
