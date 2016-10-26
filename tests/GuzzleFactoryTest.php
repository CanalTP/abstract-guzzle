<?php

namespace CanalTP\AbstractGuzzle\Tests;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use CanalTP\AbstractGuzzle\Mock\Guzzle3Mock;
use CanalTP\AbstractGuzzle\Mock\Guzzle6Mock;
use CanalTP\AbstractGuzzle\Mock\Guzzle5Mock;

class GuzzleFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function createMockedClient(array $mockedResponseCollection)
    {
        $guzzleVersion = GuzzleFactory::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 6:
                $mock = new Guzzle6Mock();
                return $mock->getMock($mockedResponseCollection);

            case 5:
                $mock = new Guzzle5Mock();
                return $mock->getMock($mockedResponseCollection);

            case 3:
                $mock = new Guzzle3Mock();
                return $mock->getMock($mockedResponseCollection);

            default:
                throw new \Exception('ttoo');
        }
    }

    public function testCreateGuzzleReturnsInitializedInstanceOfAbstractGuzzle()
    {
        $baseUri = 'http://my-base-url.tld';
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }

    public function testGetMock()
    {
        $mockedClient = $this->createMockedClient([]);
        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Guzzle', $mockedClient);
    }
}
