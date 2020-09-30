<?php

namespace Sminnee\WorkflowMax\Connector;

use Sminnee\WorkflowMax\ApiClient;
use Sminnee\WorkflowMax\Model\Client;

/**
 * A sub-client responsible for accessing job.
 */
class ClientConnector
{
    protected $client;

    public function __construct(ApiClient $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Returns a job by job number.
     *
     * @return Sminnee\WorkflowMax\Model\Client
     */
    public function byId($id)
    {
        return new Client($this->connector, $this->connector->apiCall(
            "client.api/get/$id",
            function ($result) { return $result['Client']; }
        ));
    }

    public function byStub($stubData)
    {
        return $this->byId($stubData['ID'])->populate($stubData);
    }
}
