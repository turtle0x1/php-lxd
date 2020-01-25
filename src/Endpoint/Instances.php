<?php

namespace Opensaucesystems\Lxd\Endpoint;

use Opensaucesystems\Lxd\Client;
use Opensaucesystems\Lxd\HttpClient\Message\ResponseMediator;
use Opensaucesystems\Lxd\Exception\SourceImageException;

class Instances extends InstaceBase
{
    public function getEndpoint()
    {
        return $this->client->hasVms() ? "/instances/" : "/containers/";
    }
}
