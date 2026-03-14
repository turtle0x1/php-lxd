<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS\System;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Provider extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/system/provider';
    }

    public function info()
    {
        return $this->get($this->getEndpoint());
    }
}
