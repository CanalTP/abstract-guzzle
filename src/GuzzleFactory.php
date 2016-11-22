<?php

namespace CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\Exception\UnsupportedException;
use GuzzleHttp\Psr7\Response;

class GuzzleFactory
{
    /**
     * @param string $baseUri
     * @param array $options
     * @return Version\Guzzle3|Version\Guzzle5|Version\Guzzle6
     */
    public static function createClient($baseUri, $options = [])
    {
        $guzzleVersion = self::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 6:
                return new Version\Guzzle6($baseUri, $options);

            case 5:
                return new Version\Guzzle5($baseUri, $options);

            case 3:
                return new Version\Guzzle3($baseUri, $options);
        }
    }

    /**
     * get a mock of right client
     *
     * @param Response[] $mockedResponseCollection
     * @return Guzzle
     */
    public static function createClientMock(array $mockedResponseCollection)
    {
        $guzzleVersion = self::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 6:
                $mock = new Mock\Guzzle6Mock();
                return $mock->getMock($mockedResponseCollection);

            case 5:
                $mock = new Mock\Guzzle5Mock();
                return $mock->getMock($mockedResponseCollection);

            case 3:
                $mock = new Mock\Guzzle3Mock();
                return $mock->getMock($mockedResponseCollection);
        }
    }

    /**
     * @return int current Guzzle vendor version.
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function detectGuzzleVersion()
    {
        if (self::supportsGuzzle6()) {
            return 6;
        }

        if (self::supportsGuzzle5()) {
            return 5;
        }

        if (self::supportsGuzzle3()) {
            return 3;
        }

        throw new UnsupportedException();
    }

    /**
     * @return bool
     */
    private static function supportsGuzzle6()
    {
        return class_exists('GuzzleHttp\\Client') && !trait_exists('GuzzleHttp\\HasDataTrait');
    }

    /**
     * @return bool
     */
    private static function supportsGuzzle5()
    {
        return class_exists('GuzzleHttp\\Client') && trait_exists('GuzzleHttp\\HasDataTrait');
    }

    /**
     * @return bool
     */
    private static function supportsGuzzle3()
    {
        return class_exists('Guzzle\\Service\\Client');
    }
}
