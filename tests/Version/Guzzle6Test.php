<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class Guzzle6Test extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (6 !== GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test for version 6 only');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle6', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
}
