<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;
use Opensaucesystems\Lxd\Exception\InvalidEndpointException;

class System extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/system';
    }

    public function endpoints()
    {
        $endpoints = [];
        foreach ($this->get($this->getEndpoint()) as $endpoint) {
            $endpoints[] = str_replace($this->getEndpoint() . "/", '', $endpoint);
        }
        return $endpoints;
    }

    public function factoryReset()
    {
        $this->post($this->getEndpoint() . "/:factory-reset");
    }

    public function powerOff()
    {
        $this->post($this->getEndpoint() . "/:poweroff");
    }

    public function reboot()
    {
        $this->post($this->getEndpoint() . "/:reboot");
    }

    public function __get($endpoint)
    {
        $class = __NAMESPACE__ . '\\System\\' . ucfirst($endpoint);

        if (class_exists($class)) {
            return new $class($this->client);
        } else {
            throw new InvalidEndpointException(
                'Endpoint ' . $class . ', not implemented.'
            );
        }
    }
}
