<?php

namespace Opensaucesystems\Lxd\Endpoint;

class Projects extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/projects/';
    }

    /**
     * List all projects on the server
     *
     *
     * @return array
     */
    public function all()
    {
        $projects = [];

        foreach ($this->get($this->getEndpoint()) as $project) {
            $x = str_replace('/'.$this->client->getApiVersion().$this->getEndpoint(), '', $project);
            $x = str_replace('?project=' . $this->client->getProject(), '', $x);

            $projects[] = $x;
        }

        return $projects;
    }

    public function create(string $name, string $description = "", array $config = [])
    {
        $project = [];
        $project["name"] = $name;
        $project["description"] = $description;
        $project["config"] = empty($config) ? $this->defaultProjectConfig() : $config;

        return $this->post($this->getEndpoint(), $project);
    }

    public function info(string $name)
    {
        return $this->get($this->getEndpoint() . $name);
    }

    public function replace(string $name, string $description = "", array $config = [])
    {
        $project = [];
        $project["description"] = $description;
        $project["config"] = empty($config) ? $this->defaultProjectConfig() : $config;

        return $this->put($this->getEndpoint() . $name, $project);
    }

    public function update(string $name, string $description = "", array $config = [])
    {
        $project = [];
        if (!empty($description)) {
            $project["description"] = $description;
        }
        $project["config"] = empty($config) ? $this->defaultProjectConfig() : $config;
        return $this->patch($this->getEndpoint() . $name, $project);
    }

    public function rename(string $name, string $newName)
    {
        $config = ["name"=>$newName];
        return $this->post($this->getEndpoint() . $name, $config);
    }

    public function remove(string $name)
    {
        return $this->delete($this->getEndpoint() . $name);
    }

    private function defaultProjectConfig()
    {
        return [
            "features.images"=>"true",
            "features.profiles"=>"true",
        ];
    }
}
