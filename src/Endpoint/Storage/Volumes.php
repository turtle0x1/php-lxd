<?php

namespace Opensaucesystems\Lxd\Endpoint\Storage;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Volumes extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/storage-pools/';
    }

    public function all($pool)
    {
        return $this->get($this->getEndpoint().$pool.'/volumes');
    }

    /**
     * $path for /1.0/storage-pools/default/volumes/custom/test would be custom/test
     */
    public function info(string $pool, string $path)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->get($this->getEndpoint().$pool.'/volumes/'. $path, $config);
    }
}
