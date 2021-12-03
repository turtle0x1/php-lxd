<?php

namespace Opensaucesystems\Lxd\Endpoint;

class Networks extends AbstractEndpoint
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
    public function all($recursion = 0)
    {
        $networks = [];

        $config = [
            "project"=>$this->client->getProject(),
            "recursion"=>$recursion
        ];

        foreach ($this->get($this->getEndpoint(), $config) as $network) {
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
        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->get($this->getEndpoint().$name, $config);
    }

    /**
     * Create a network
     *
     * @param  string $name name of network
     * @param  array  $config configuration of the network (Optional)
     * @return object
     */
    public function create(string $name, string $description = "", array $config = [], $type = "")
    {
        $data = [];

        $data["name"] = $name;
        $data["description"] = $description;
        if (!empty($config)) {
            $data["config"] = $config;
        }
        $data["type"] = $type;

        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->post($this->getEndpoint(), $data, $config);
    }

    /**
     * Delete network
     * @param string $name name of network
     * @return object
     */
    public function remove($name)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->delete($this->getEndpoint().$name, $config);
    }
}
