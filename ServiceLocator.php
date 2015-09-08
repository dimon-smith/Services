<?php

namespace Services;

use InvalidArgumentException;

/**
 * The main problem with Service Locators is that all classes depend on the
 * Service Locator :) So I'm surprised that there is still no corresponding PSR.
 * And since the corresponding PSR does not exist in nature, I present for you
 * a simple version of the Service Locator.
 */
final class ServiceLocator
{
    protected static $registry = [];

    protected static $instances = [];

    public function set($name, $service, $owerride = false)
    {
        if (! $owerride && $this->has($name)) {
            throw new InvalidArgumentException(
                sprintf(
                    'A service by the name "%s" already exists.',
                    $name
                )
            );
        }
        if (is_object($service)) {
            self::$registry[$name]  = get_class($service);
            self::$instances[$name] = $service;
            return;
        }

        self::$registry[$name] = $service;
    }

    public function get($name, $shared = true)
    {
        if (! $shared) {
            if (! array_key_exists($name, self::$registry)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'A service by the name %s was not found.',
                        $name
                    )
                );
            }
            return new self::$registry[$name];
        }

        if (array_key_exists($name, self::$instances)) {
            return self::$instances[$name];
        }

        if (array_key_exists($name, self::$registry)) {
            $instance = is_string(self::$registry[$name])
                ? new self::$registry[$name]
                : self::$registry[$name];

            self::$instances[$name] = $instance;
            return $instance;
        }

        throw new InvalidArgumentException(
            sprintf(
                'A service by the name %s was not found.',
                $name
            )
        );
    }

    public function remove($name, $shared = true)
    {
        if (array_key_exists($name, self::$instances)) {
            unset(self::$instances[$name]);
        }

        if (! $shared && array_key_exists($name, self::$registry)) {
            unset(self::$egistry[$name]);
        }
    }

    public function has($name)
    {
        return isset(self::$registry[$name]);
    }
}