<?php

namespace Sminnee\WorkflowMax\Connector;

use Sminnee\WorkflowMax\ApiClient;
use Sminnee\WorkflowMax\Model\Staff;

/**
 * A sub-client responsible for accessing job.
 */
class StaffConnector extends TypeConnector
{
    protected $connector;

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
        return new Staff($this->connector, $this->connector->apiCall(
            "staff.api/get/$id",
            function ($result) { return $result['Staff']; }
        ));
    }

    public function all()
    {
        return $this->listFromApiCall($this->connector->apiCall(
            'staff.api/list',
            function ($result) { return $result['StaffList']['Staff']; }
        ));
    }

    public function byStub($stubData)
    {
        return $this->byId($stubData['ID'])->populate($stubData);
    }
}
