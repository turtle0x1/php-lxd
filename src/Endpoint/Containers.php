<?php

namespace Opensaucesystems\Lxd\Endpoint;

class Containers extends InstaceBase
{
    protected function getEndpoint()
    {
        return '/containers/';
    }
}
