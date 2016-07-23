<?php

namespace Tests\CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class GuzzleFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (6 === GuzzleFactory::detectGuzzleVersion()) {
            $this->markTestSkipped('test compatible for version 5 and less');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUrl = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUrl);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $guzzle);
        $this->assertEquals($baseUrl, $guzzle->getBaseUrl());
    }

}
