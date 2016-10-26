<?php

namespace CanalTP\AbstractGuzzle\tests\Version;

use CanalTP\AbstractGuzzle\GuzzleFactory;
use CanalTP\AbstractGuzzle\Mock\Guzzle3Mock;
use Guzzle\Http\Message\Response;

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
        $guzzle = GuzzleFactory::createGuzzle($baseUri);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle3', $guzzle);
        $this->assertEquals($baseUri, $guzzle->getBaseUri());
    }
    
    public function testMockedGuzzle()
    {
        $responseCollection = [
            new Response(200, ['content-type' => 'application/json', 'content-length' => 26, 'canaltp' => 42]),
        ];

        $mock = new Guzzle3Mock();
        $mockedGuzzle = $mock->getMock($responseCollection);

        $this->assertInstanceOf('CanalTP\\AbstractGuzzle\\Version\\Guzzle3', $mockedGuzzle);

        // check that first call is mocked
        $firstCall = $mockedGuzzle->get('/impossibru');
        $firstCallHeaders = $firstCall->getHeaders();
        $this->assertEquals(200, $firstCall->getStatusCode());
        $this->assertEquals(42, $firstCallHeaders['canaltp'][0]);
        $this->assertEquals('application/json', $firstCallHeaders['content-type'][0]);
    }
}
