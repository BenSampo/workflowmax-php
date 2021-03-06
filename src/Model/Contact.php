<?php

    namespace Sminnee\WorkflowMax\Model;

    /**
     * Represents a single contact.
     *
     * @property-read string $ID
     * @property-read string $IsPrimary
     * @property-read string $Name
     * @property-read string $Salutation
     * @property-read string $Addressee
     * @property-read string $Mobile
     * @property-read string $Email
     * @property-read string $Phone
     * @property-read string $Position
     */
    class Contact
    {
        use ModelBase;

        /**
         * @param $data
         *
         * @return mixed
         * @throws \Exception
         */
        public function processData($data)
        {
            return $data;
        }
    }
