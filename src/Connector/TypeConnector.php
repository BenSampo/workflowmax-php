<?php

namespace Sminnee\WorkflowMax\Connector;

use iter;
use Sminnee\WorkflowMax\ApiCall;

/**
 * Base class for all type-specific sub-connectors.
 */
abstract class TypeConnector
{
    /**
     * Return a list of items from the given ApiCall.
     * @param  ApiCall $apiCall [description]
     * @return \Iterator
     */
    public function listFromApiCall(ApiCall $apiCall)
    {
        $self = $this;

        return iter\map(function ($record) use ($self) {
            return $self->byStub($record);
        }, $apiCall);
    }

    abstract public function byStub($stubData);
}
