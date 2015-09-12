<?php

namespace Services;

use ServiceLocator as Services;

interface ServicesVisitorInterface
{
    public function visit(Services $services);
}