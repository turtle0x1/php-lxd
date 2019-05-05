<?php

namespace Opensaucesystems\Lxd\Endpoint;

class Networks extends AbstructEndpoint
{
    protected function getEndpoint()
    {
        return '/networks/';
    }

    /**
     * List of networks
     *
     * This is an alias of the get method with an empty string as the parameter
     *
     * @return array
     */
    public function all()
    {
        $networks = [];

        foreach ($this->get($this->getEndpoint()) as $network) {
            $networks[] = str_replace('/'.$this->client->getApiVersion().$this->getEndpoint(), '', $network);
        }

        return $networks;
    }

    /**
     * Show information on a network
     *
     * @param  string $name name of network
     * @return object
     */
    public function info($name)
    {
        return $this->get($this->getEndpoint().$name);
    }

    /**
     * Create a network
     *
     * @param  string $name name of network
     * @param  array  $config configuration of the network (Optional)
     * @return object
     */
    public function create(string $name, string $description = "", array $config = [])
    {
        $data = [];

        $data["name"] = $name;
        $data["description"] = $description;
        if (!empty($config)) {
            $data["config"] = $config;
        }

        return $this->post($this->getEndpoint(), $data);
    }

    /**
     * Delete network
     * @param string $name name of network
     * @return object
     */
    public function remove($name)
    {
        return $this->delete($this->getEndpoint().$name);
    }
}
