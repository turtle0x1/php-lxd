<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS\System;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Resources extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/system/resources';
    }

    public function info()
    {
        return $this->get($this->getEndpoint());
    }
}
