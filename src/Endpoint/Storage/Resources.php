<?php

namespace Opensaucesystems\Lxd\Endpoint\Storage;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Resources extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/storage-pools/';
    }

    /**
     */
    public function info($name)
    {
        return $this->get($this->getEndpoint().$name.'/resources');
    }
}
