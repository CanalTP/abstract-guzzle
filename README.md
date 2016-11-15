Abstract Guzzle
===============

[![Build Status](https://travis-ci.org/CanalTP/abstract-guzzle.svg?branch=master)](https://travis-ci.org/CanalTP/abstract-guzzle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/CanalTP/abstract-guzzle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/CanalTP/abstract-guzzle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/canaltp/abstract-guzzle/v/stable)](https://packagist.org/packages/canaltp/abstract-guzzle)
[![License](https://poser.pugx.org/canaltp/abstract-guzzle/license)](https://packagist.org/packages/canaltp/abstract-guzzle)

Allows to use multiple versions of [Guzzle](https://github.com/guzzle/guzzle) in a same project.

It uses an abstract Guzzle client which handle [PSR-7](http://www.php-fig.org/psr/psr-7/) Request and Response objects,
so **whatever your Guzzle version**, you can **send Request and handle Response the same way**.


## Composer

Install via composer:

``` js
{
    "require": {
        "canaltp/abstract-guzzle": "~1.0.0"
    }
}
```


## Usage

``` php
use GuzzleHttp\Psr7\Request;
use CanalTP\AbstractGuzzle\GuzzleFactory;

$baseUri = 'http://api.my-app.com/v1/';

// Instanciate an abstract Guzzle client
$guzzle = GuzzleFactory::createGuzzle($baseUri);

// Create a PSR-7 Request
$request = new Request('PATCH', 'users/4', ['Content-Type' => 'application/json'], '{"username":"new_username"}');

// Send your request
$response = $guzzle->send($request);

// Get content of your PSR-7 Response
$result = $response->getBody();
```

Or use shortcut methods:

``` php
use CanalTP\AbstractGuzzle\GuzzleFactory;

$baseUri = 'http://api.my-app.com/v1/';

// Instanciate an abstract Guzzle client
$guzzle = GuzzleFactory::createGuzzle($baseUri);

$response = $guzzle->patch('users/4', ['Content-Type' => 'application/json'], '{"username":"new_username"}');
$result = $response->getBody();
```

## Mocking guzzle client

``` php
use CanalTP\AbstractGuzzle\GuzzleFactory;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

// use factory to easily create client mock and add the response you expect
$clientMock = GuzzleFactory::createClientMock([
    new Response(200, ['content-type' => 'application/json', 'content-length' => 26, 'canaltp' => 42]),
    new Response(200, [], '{"lines":"expected-lines"}'),
    new Response(404, ['Content-Length' => 0])
]);

// here some examples of assert
$firstCall = $clientMock->send(new Request('get', 'github'));
$firstCallHeaders = $firstCall->getHeaders();
$this->assertInstanceOf('GuzzleHttp\\Psr7\\Response', $firstCall);
$this->assertEquals(200, $firstCall->getStatusCode());
$this->assertEquals(42, $firstCallHeaders['canaltp'][0]);
$this->assertEquals('application/json', $firstCallHeaders['content-type'][0]);

```

### Supported Guzzle versions

 - Guzzle 3
 - Guzzle 5
 - Guzzle 6


## Testing

Running tests:

``` bash
vendor\bin\phpunit -c .
```

Check coding style:

``` bash
vendor\bin\phpcs --standard=PSR2 src
```


## License

This project is under [MIT License](LICENSE).
