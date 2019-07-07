<?php

namespace Railroad\AddEventManager;

use Illuminate\Console\Command;

class Synchronize extends Command
{
    /**
     * @var Synchronizer
     */
    private $synchronizer;

    public function __construct(Synchronizer $synchronizer)
    {
        parent::__construct();

        $this->synchronizer = $synchronizer;
    }
}
