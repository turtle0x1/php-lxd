<?php

namespace Opensaucesystems\Lxd\Endpoint\IncusOS;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Applications extends AbstractEndpoint
{

    protected function getEndpoint()
    {
        return '/os/1.0/applications';
    }

    public function all()
    {
        $applications = [];
        foreach ($this->get($this->getEndpoint()) as $application) {
            $applications[] = str_replace($this->getEndpoint() . "/", '', $application);
        }
        return $applications;
    }

    public function info(string $application)
    {
        return $this->get($this->getEndpoint() . "/" . $application);
    }
}
