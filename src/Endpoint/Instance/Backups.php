<?php

namespace Opensaucesystems\Lxd\Endpoint\Instance;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Backups extends AbstractEndpoint
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
     * Get all backups for a particular container
     * @param string $container Container name
     * @return object
     */
    public function all(string $container)
    {
        $backups = [];

        $config = [
            "project"=>$this->client->getProject()
        ];

        foreach ($this->get($this->getEndpoint().$container.'/backups/', $config) as $backup) {
            $backup = str_replace(
                '/'.$this->client->getApiVersion().$this->getEndpoint().$container.'/backups/',
                '',
                $backup
            );
            $backup = str_replace("?project=".$config["project"], "", $backup);
            $backups[] = $backup;
        }

        return $backups;
    }
    /**
     * Get info for a container backup
     * @param string $container Container name
     * @param string $name      Backup name
     * @return object
     */
    public function info(string $container, string $name)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->get($this->getEndpoint().$container.'/backups/'.$name, $config);
    }
    /**
     * Create a backup for a container
     * @param string $container Name of the container
     * @param string $name      Name of the backup
     * @param array  $opts      Options for the backup
     * @param bool   $wait      Wait for the backup operation to finish
     * @return object
     */
    public function create(string $container, string $name, array $opts, $wait = false)
    {
        $opts = array_merge([
            "name"=>$name
        ], $opts);

        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->post($this->getEndpoint().$container.'/backups', $opts, $config);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }
    /**
     * Rename a container backup
     * @param string $container Name of the container
     * @param string $name      Name of the backup
     * @param string $newBackup New name for the backup
     * @param bool   $wait      Wait for the rename operation to finish
     * @return object
     */
    public function rename(string $container, string $name, string $newBackup, $wait = false)
    {
        $opts = [
            "name"=>$newBackup
        ];

        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->post($this->getEndpoint().$container.'/backups/'.$name, $opts, $config);


        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }
    /**
     * Remove a container backup
     * @param string $container Name of a container
     * @param string $name      Name of the backup
     * @param bool   $wait      Wait for the delete operation to finish
     * @return object
     */
    public function remove(string $container, string $name, $wait = false)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->delete($this->getEndpoint().$container.'/backups/'.$name, $config);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }
    /**
     * Download a backup
     * @param string $container Name of a container
     * @param string $name      Name of the backup
     * @return object
     */
    public function export(string $container, string $name)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->get($this->getEndpoint().$container.'/backups/'.$name . "/export", $config);

        return $response;
    }
}
