<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class Guzzle5Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (5 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 5 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle5', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
}
