<?php

namespace Opensaucesystems\Lxd\Endpoint;

class Storage extends AbstructEndpoint
{
    protected function getEndpoint()
    {
        return '/storage-pools/';
    }

    public function all()
    {
        $storagePools = [];
        foreach ($this->get($this->getEndpoint()) as $pool) {
            $storagePools[] = str_replace('/'.$this->client->getApiVersion().$this->getEndpoint(), '', $pool);
        }
        return $storagePools;
    }

    public function info(string $name)
    {
        return $this->get($this->getEndpoint().$name);
    }

    public function create(string $name, string $driver, array $config)
    {
        $pool = [
            "name"=>$name,
            "driver"=>$driver,
            "config"=>$config
        ];

        return $this->post($this->getEndpoint(), $pool);
    }

    public function replace(string $name, array $config)
    {
        return $this->put($this->getEndpoint().$name, ["config"=>$config]);
    }

    public function update(string $name, array $config)
    {
        return $this->patch($this->getEndpoint().$name, ["config"=>$config]);
    }

    public function remove(string $name)
    {
        return $this->delete($this->getEndpoint().$name);
    }

    public function __get($endpoint)
    {
        $class = __NAMESPACE__.'\\Storage\\'.ucfirst($endpoint);

        if (class_exists($class)) {
            return new $class($this->client);
        } else {
            throw new InvalidEndpointException(
                'Endpoint '.$class.', not implemented.'
            );
        }
    }
}
