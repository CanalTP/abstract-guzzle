<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class Guzzle3Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (3 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 3 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle3', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
}
