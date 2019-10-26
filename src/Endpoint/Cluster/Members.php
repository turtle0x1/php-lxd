<?php

namespace Opensaucesystems\Lxd\Endpoint\Cluster;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Members extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/cluster/members/';
    }

    /**
     * List of members of a cluster
     *
     * @return array
     */
    public function all()
    {
        $members = [];

        foreach ($this->get($this->getEndpoint()) as $member) {
            $members[] = str_replace('/'.$this->client->getApiVersion().$this->getEndpoint(), '', $member);
        }

        return $members;
    }

    public function info(string $name)
    {
        return $this->get($this->getEndpoint()."$name");
    }

    public function rename(string $name, string $newName)
    {
        return $this->post($this->getEndpoint()."$name", ["server_name"=>$newName]);
    }

    public function remove(string $name)
    {
        return $this->delete($this->getEndpoint()."$name");
    }
}
