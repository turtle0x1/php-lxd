<?php

namespace Opensaucesystems\Lxd\Endpoint;

use Opensaucesystems\Lxd\Client;
use Opensaucesystems\Lxd\HttpClient\Message\ResponseMediator;
use Opensaucesystems\Lxd\Exception\SourceImageException;

class Cluster extends AbstructEndpoint
{
    protected function getEndpoint()
    {
        return '/cluster/';
    }

    /**
     * List all containers on the server
     *
     * This is an alias of the get method with an empty string as the parameter
     *
     * @return array
     */
    public function info()
    {
        return $this->get($this->getEndpoint());
    }

    public function __get($endpoint)
    {
        $class = __NAMESPACE__.'\\Cluster\\'.ucfirst($endpoint);

        if (class_exists($class)) {
            return new $class($this->client);
        } else {
            throw new InvalidEndpointException(
                'Endpoint '.$class.', not implemented.'
            );
        }
    }
}
