<?php

namespace Opensaucesystems\Lxd\Endpoint\Storage;

use Opensaucesystems\Lxd\Endpoint\AbstructEndpoint;

class Volumes extends AbstructEndpoint
{
    protected function getEndpoint()
    {
        return '/storage-pools/';
    }

    /**
     */
    public function info($name)
    {
        return $this->get($this->getEndpoint().$name.'/volumes');
    }
}
