<?php

namespace Opensaucesystems\Lxd\Endpoint\Instance;

use Opensaucesystems\Lxd\Endpoint\AbstractEndpoint;

class Snapshots extends AbstractEndpoint
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
     * List of snapshots for a container
     *
     * @param  string $name Name of container
     * @return array
     */
    public function all($name)
    {
        $snapshots = [];

        $config = [
            "project"=>$this->client->getProject()
        ];

        foreach ($this->get($this->getEndpoint().$name.'/snapshots/', $config) as $snapshot) {
            $snapshot = str_replace(
                '/'.$this->client->getApiVersion().$this->getEndpoint().$name.'/snapshots/',
                '',
                $snapshot
            );
            $snapshot = str_replace("?project=".$config["project"], "", $snapshot);
            $snapshots[] = $snapshot;
        }

        return $snapshots;
    }

    /**
     * Show information on a snapshot
     *
     * @param string $name      Name of container
     * @param string $snapshots Name of snapshots
     * @return object
     */
    public function info($name, $snapshot)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        return $this->get($this->getEndpoint().$name.'/snapshots/'.$snapshot, $config);
    }

    /**
     * Create a snapshot of a container
     *
     * If stateful is true when creating a snapshot of a
     * running container, the container's runtime state will be stored in the
     * snapshot.  Note that CRIU must be installed on the server to create a
     * stateful snapshot, or LXD will return a 500 error.
     *
     * @param  string $name     Name of container
     * @param  string $snapshot Name of snapshot
     * @param  bool   $stateful Whether to save runtime state for a running container
     * @param  bool   $wait     Wait for operation to finish
     * @return object
     */
    public function create($name, $snapshot, $stateful = false, $wait = false)
    {
        $opts['name']     = $snapshot;
        $opts['stateful'] = $stateful;

        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->post($this->getEndpoint().$name.'/snapshots', $opts, $config);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }

    /**
     * Restore a snapshot of a container
     *
     * @param  string $name     Name of container
     * @param  string $snapshot Name of snapshot
     * @param  bool   $wait     Wait for operation to finish
     * @return object
     */
    public function restore($name, $snapshot, $wait = false)
    {
        $opts['restore']  = $snapshot;

        $response = $this->client->containers->replace($name, $opts, $wait);

        return $response;
    }

    /**
     * Rename a snapshot
     *
     * @param string $name        Name of container
     * @param string $snaphot     Name of snapshot
     * @param string $newSnapshot Name of new snapshot
     * @param bool   $wait        Wait for operation to finish
     * @return object
     */
    public function rename($name, $snaphot, $newSnapshot, $wait = false)
    {
        $opts['name'] = $newSnapshot;
        $config = [
            "project"=>$this->client->getProject()
        ];
        $response = $this->post($this->getEndpoint().$name.'/snapshots/'.$snaphot, $opts, $config);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }

    /**
     * Delete a container
     *
     * @param string $name    Name of container
     * @param string $snaphot Name of snapshot
     * @param bool   $wait    Wait for operation to finish
     * @return object
     */
    public function remove($name, $snaphot, $wait = false)
    {
        $config = [
            "project"=>$this->client->getProject()
        ];

        $response = $this->delete($this->getEndpoint().$name.'/snapshots/'.$snaphot, $config);

        if ($wait) {
            $response = $this->client->operations->wait($response['id']);
        }

        return $response;
    }
}
