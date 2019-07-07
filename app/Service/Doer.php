<?php

namespace Railroad\AddEventManager;

use Railroad\AddEventSdk\Connector;
use Railroad\AddEventSdk\Helper;

class Doer
{
    /**
     * @var Connector
     */
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function getCalendars()
    {
        try {
            return $this->connector->getCalendars();
        } catch (\Exception $e) {
            error_log($e);
        }
        
        return false;
    }
}
