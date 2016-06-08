<?php

namespace CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\Exception\UnsupportedException;

class GuzzleFactory
{
    /**
     * @param string $baseUrl
     *
     * @return Guzzle
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function createGuzzle($baseUrl)
    {
        $guzzleVersion = self::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 5:
                return new Version\Guzzle5($baseUrl);

            case 3:
                return new Version\Guzzle3($baseUrl);
        }
    }

    /**
     * @return int current Guzzle vendor version.
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function detectGuzzleVersion()
    {
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
    private static function supportsGuzzle5()
    {
        return class_exists('GuzzleHttp\\Client');
    }

    /**
     * @return bool
     */
    private static function supportsGuzzle3()
    {
        return class_exists('Guzzle\\Service\\Client');
    }
}
