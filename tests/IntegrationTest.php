<?php

namespace CanalTP\AbstractGuzzle\Tests;

use CanalTP\AbstractGuzzle\GuzzleFactory;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testSetDefaultAuth()
    {
        $client = GuzzleFactory::createClient('https://api.navitia.io/v1/coverage/sandbox/');
        $client->setDefaultAuth('3b036afe-0110-4202-b9ed-99718476c2e0', null);

        $this->assertEquals(200, $client->call('get', 'lines')->getStatusCode());
    }

    public function testAddOptionAtConstruct()
    {
        $client = GuzzleFactory::createClient('https://api.navitia.io/v1/coverage/sandbox/', ['auth' => ['3b036afe-0110-4202-b9ed-99718476c2e0', null]]);
        $request = $client->call('get', 'lines');

        $this->assertEquals(200, $request->getStatusCode());
    }
}
