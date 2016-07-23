<?php

namespace CanalTP\AbstractGuzzle;

use CanalTP\AbstractGuzzle\Exception\UnsupportedException;

class GuzzleFactory
{
    /**
     * @param array $config
     *
     * @return Guzzle
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function createGuzzle($config)
    {
        $guzzleVersion = self::detectGuzzleVersion();

        switch ($guzzleVersion) {
            case 6:
                return new Version\Guzzle6($config);
                
            case 5:
                return new Version\Guzzle5($config);

            case 3:
                return new Version\Guzzle3($config);
        }
    }

    /**
     * @return int current Guzzle vendor version.
     *
     * @throws NotSupportedException when Guzzle vendor version is not supported.
     */
    public static function detectGuzzleVersion()
    {
        // this namespace only exist since version 5.x+
        if (class_exists('GuzzleHttp\\Client')) {

            // default request options are defined differently in version 5 and 6
            $clientReflexion = new \ReflectionClass('GuzzleHttp\\Client');
            if ($clientReflexion->hasProperty('config')) {
                return 6;
            }

            if ($clientReflexion->hasProperty('defaults')) {
                return 5;
            }
        }

        if (class_exists('Guzzle\\Service\\Client')) {
            return 3;
        }

        throw new UnsupportedException();
    }
}
