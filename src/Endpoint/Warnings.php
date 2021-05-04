<?php

namespace Opensaucesystems\Lxd\Endpoint;

use Opensaucesystems\Lxd\Exception\InvalidEndpointException;

class Warnings extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/warnings/';
    }

    public function all(string $project = null, int $recursion = 1)
    {
        $config = [
            "recursion"=>1
        ];

        if (!empty($project)) {
            $config["project"] = $project;
        }


        return $this->get($this->getEndpoint(), $config);
    }

    public function info(string $uuid)
    {
        return $this->get($this->getEndpoint() . $uuid);
    }

    public function remove(string $uuid)
    {
        return $this->delete($this->getEndpoint() . $uuid);
    }

    public function __get($endpoint)
    {
        $class = __NAMESPACE__.'\\Warnings\\'.ucfirst($endpoint);

        if (class_exists($class)) {
            return new $class($this->client);
        } else {
            throw new InvalidEndpointException(
                'Endpoint '.$class.', not implemented.'
            );
        }
    }
}
