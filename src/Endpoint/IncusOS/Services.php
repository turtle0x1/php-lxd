<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Services extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/services';
    }

    public function all()
    {
        $services = [];
        foreach ($this->get($this->getEndpoint()) as $service) {
            $services[] = str_replace($this->getEndpoint() . "/", '', $service);
        }
        return $services;
    }

    public function info(string $service)
    {
        return $this->get($this->getEndpoint() . "/" . $service);
    }
}
