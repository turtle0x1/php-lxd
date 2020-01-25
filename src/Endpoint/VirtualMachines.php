<?php

namespace Opensaucesystems\Lxd\Endpoint;

class VirtualMachines extends InstaceBase
{
    protected function getEndpoint()
    {
        return '/virtual-machines/';
    }
}
