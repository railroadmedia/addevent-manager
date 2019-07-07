<?php

namespace Railroad\AddEventManager;

use Railroad\AddEventSdk\Connector;


class Evaluator
{
    /**
     * @var Connector
     */
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }


}
