<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS\System;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Update extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/system/update';
    }

    public function info()
    {
        return $this->get($this->getEndpoint());
    }

    public function check()
    {
        return $this->post($this->getEndpoint() . "/:check");
    }
}
