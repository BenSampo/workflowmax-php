<?php

    namespace Sminnee\WorkflowMax\Connector;

    use Sminnee\WorkflowMax\ApiClient;
    use Sminnee\WorkflowMax\Model\Contact;

    /**
     * A sub-contact responsible for accessing job.
     */
    class ContactConnector
    {
        /**
         * @var
         */
        protected $contact;

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
         * Returns a job by job number.
         *
         * @return Sminnee\WorkflowMax\Model\Contact
         */
        public function byId($id)
        {
            return new Contact($this->connector, $this->connector->apiCall(
                "client.api/contact/$id",
                function ($result) { return $result['Contact']; }
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
    }
