<?php

namespace Services;

use ServiceLocator as Services;

class ServicesConfigVisitor implements ServicesVisitorInterface
{
    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function visit(Services $services)
    {
        foreach ($this->config as $name => $service) {
            $services->set($name, $service, true);
        }
    }
}