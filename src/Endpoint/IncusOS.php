<?php

namespace Opensaucesystems\Lxd\Endpoint;

use Opensaucesystems\Lxd\Exception\InvalidEndpointException;

class IncusOS extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '';
    }

    public function __get($endpoint)
    {
        $class = __NAMESPACE__ . '\\IncusOS\\' . ucfirst($endpoint);

        if (class_exists($class)) {
            return new $class($this->client);
        } else {
            throw new InvalidEndpointException(
                'Endpoint ' . $class . ', not implemented.'
            );
        }
    }
}
