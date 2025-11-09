<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS\System;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Logging extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/system/logging';
    }

    public function info()
    {
        return $this->get($this->getEndpoint());
    }
}
