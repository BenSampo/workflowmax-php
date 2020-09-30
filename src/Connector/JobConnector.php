<?php

namespace Sminnee\WorkflowMax\Connector;

use Datetime;
use Sminnee\WorkflowMax\ApiClient;
use Sminnee\WorkflowMax\Model\Job;

/**
 * A sub-client responsible for accessing job.
 */
class JobConnector extends TypeConnector
{
    protected $connector;

    public function __construct(ApiClient $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Returns a job byId job number.
     *
     * @return Sminnee\WorkflowMax\Model\Job
     */
    public function byId($job)
    {
        return new Job($this->connector, $this->connector->apiCall(
            "job.api/get/$job",
            function ($result) { return $result['Job']; }
        ));
    }

    public function byStub($stubData)
    {
        return $this->byId($stubData['ID'])->populate($stubData);
    }

    /**
     * Returns a list of jobs in a date range.
     *
     * @param Datetime $start The date at the start of the date range
     * @param Datetime $end The date at the end of the date range
     */
    public function byDateRange(Datetime $start, Datetime $end)
    {
        //
    }

    public function current()
    {
        return $this->listFromApiCall($this->connector->apiCall('job.api/current', function ($result) {
            return isset($result['Jobs']['Job']) ? $result['Jobs']['Job'] : [];
        }));
    }
}
