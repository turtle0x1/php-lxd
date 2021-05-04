<?php

namespace Opensaucesystems\Lxd\Endpoint\Warnings;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Status extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/warnings/';
    }

    public function new(string $uuid)
    {
        $data = ["status"=>"new"];
        return $this->put($this->getEndpoint() . $uuid, $data);
    }

    public function acknowledge(string $uuid)
    {
        $data = ["status"=>"acknowledged"];
        return $this->put($this->getEndpoint() . $uuid, $data);
    }
}
