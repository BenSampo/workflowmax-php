<?php

namespace Sminnee\WorkflowMax\Connector;

use Datetime;
use Sminnee\WorkflowMax\ApiClient;
use Sminnee\WorkflowMax\Model\Timesheet;

/**
 * A sub-client responsible for accessing job.
 */
class TimesheetConnector extends TypeConnector
{
    protected $client;

    public function __construct(ApiClient $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Returns a job by job number.
     *
     * @return Sminnee\WorkflowMax\Model\Timesheet
     */
    public function byId($id)
    {
        return new Timesheet($this->connector, $this->connector->apiCall(
            "time.api/get/$id",
            function ($result) {
                return $result['Time'];
            }
        ));
    }

    /**
     * Returns timesheets for a given job.
     *
     * @return \Iterator
     */
    public function byJob($jobId)
    {
        return $this->listFromApiCall($this->connector->apiCall(
            "time.api/job/$jobId",
            function ($result) {
                return isset($result['Times']['Time']) ? $result['Times']['Time'] : [];
            }
        ));
    }

    public function byStub($stubData)
    {
        return $this->byId($stubData['ID'])->populate($stubData);
    }

    /**
     * Returns all timesheet entries in a given date range.
     *
     * @param Datetime $start The date at the start of the date range
     * @param Datetime $end The date at the end of the date range
     *
     * @return \Iterator
     */
    public function byDateRange(Datetime $start, Datetime $end)
    {
        $params = 'from=' . urlencode($start->format('Ymd')) . '&to=' . urlencode($end->format('Ymd'));

        return $this->listFromApiCall($this->connector->apiCall(
            'time.api/list?' . $params,
            function ($result) {
                return isset($result['Times']['Time']) ? $result['Times']['Time'] : [];
            }
        ));
    }

    /**
     * Return timesheet entries for a single day.
     */
    public function byDay($day)
    {
        return $this->byDateRange($day, $day);
    }
}
