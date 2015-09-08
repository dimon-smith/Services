<?php

namespace Services;

trait ServiceLocatorAwareTrait
{
    private $services;

    public function setServices(ServiceLocator $services)
    {
        $this->services = $services;
    }

    public function getServices()
    {
        if (! $this->services instanceof ServiceLocator) {
            $this->services = new ServiceLocator;
        }
        return $this->services;
    }
}