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
        return $this->get($this->getEndpoint() . $pool . '/volumes');
    }

    /**
     * $path for /1.0/storage-pools/default/volumes/custom/test would be custom/test
     */
    public function info(string $pool, string $path)
    {
        $config = [
            "project" => $this->client->getProject()
        ];

        return $this->get($this->getEndpoint() . $pool . '/volumes/' . $path, $config);
    }

    public function create(string $pool, string $name, array $config)
    {
        $opts['name']     = $name;
        $opts["config"] = $config;

        $httpConfig = [
            "project" => $this->client->getProject()
        ];

        return $this->post($this->getEndpoint() . $pool . '/volumes/custom', $opts, $httpConfig);
    }

    public function createCustomVolumeFromFile(string $pool, string $name, $fileContents, string $type = "iso", bool $wait = false)
    {
        $headers = [
            "Content-Type" => "application/octet-stream",
            "X-LXD-name" => $name,
            "X-LXD-type" => $type
        ];
        $queryParams = ["project" => $this->client->getProject()];

        $response  = $this->post($this->getEndpoint() . $pool . '/volumes/custom', $fileContents, $queryParams, $headers);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }

    public function remove(string $pool, string $name)
    {
        $httpConfig = [
            "project" => $this->client->getProject()
        ];

        return $this->delete($this->getEndpoint() . $pool . '/volumes/' . $name, [], $httpConfig);
    }
}
