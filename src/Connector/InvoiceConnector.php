<?php

namespace Sminnee\WorkflowMax\Connector;

use Sminnee\WorkflowMax\ApiClient;
use Sminnee\WorkflowMax\Model\Invoice;

/**
 * A sub-contact responsible for accessing job.
 */
class InvoiceConnector extends TypeConnector
{
    /**
     * @var
     */
    protected $connector;

    /**
     * ContactConnector constructor.
     *
     * @param \Sminnee\WorkflowMax\ApiClient $connector
     */
    public function __construct(ApiClient $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Returns an invoice byId invoice number.
     *
     * @return Sminnee\WorkflowMax\Model\Invoice
     */
    public function byId($invoice)
    {
        return new Invoice($this->connector, $this->connector->apiCall(
            "invoice.api/get/$invoice",
            function ($result) {
                return $result['Invoice'];
            }
        ));
    }

    /**
     * @param $stubData
     *
     * @return mixed
     */
    public function byStub($stubData)
    {
        return $this->byId($stubData['ID'])->populate($stubData);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->listFromApiCall($this->connector->apiCall('invoice.api/current', function ($result) {
            return isset($result['Invoices']['Invoice']) ? $result['Invoices']['Invoice'] : [];
        }));
    }
}
