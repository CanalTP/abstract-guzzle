<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class GuzzleFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
}
