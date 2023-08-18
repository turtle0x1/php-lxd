<?php

namespace Opensaucesystems\Lxd\Endpoint\Instance\Logs;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class ExecOutput extends AbstractEndpoint
{
    private $endpoint;

    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * List of exec record-output logs for a container
     *
     * @param  string $name Name of container
     * @return array
     */
    public function all($name)
    {
        $logs = [];

        foreach ($this->get($this->getEndpoint().$name.'/logs/exec-output/') as $log) {
            $logs[] = str_replace(
                '/'.$this->client->getApiVersion().$this->getEndpoint().$name.'/logs/exec-output/',
                '',
                $log
            );
        }

        return $logs;
    }

    /**
     * Get the contents of a particular exec record-output log file
     *
     * @param string $name  Name of container
     * @param string $log   Name of log
     * @return object
     */
    public function read($name, $log)
    {
        return $this->get($this->getEndpoint().$name.'/logs/exec-output/'.$log);
    }

    /**
     * Remove a particular exec record-output log file
     *
     * @param string $name  Name of container
     * @param string $log   Name of log
     * @return object
     */
    public function remove($name, $log)
    {
        return $this->delete($this->getEndpoint().$name.'/logs/exec-output/'.$log);
    }
}
