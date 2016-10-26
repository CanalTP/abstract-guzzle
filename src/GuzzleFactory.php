<?php

namespace CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\Exception\UnsupportedException;

class GuzzleFactory
{
    /**
     * @param string $baseUri
     *
     * @return Guzzle
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function createGuzzle($baseUri, $options = [])
    {
        $guzzleVersion = self::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 6:
                return new Version\Guzzle6($baseUri, $options);

            case 5:
                return new Version\Guzzle5($baseUri);

            case 3:
                return new Version\Guzzle3($baseUri);
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
