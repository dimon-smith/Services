<?php

namespace Services;

class ServicesConfigVisitor
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