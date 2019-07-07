<?php

namespace Railroad\AddEventManager\Console\Commands;

use Illuminate\Console\Command;

class Commander extends Command
{
    public $signature = 'addevent';

    public $description = 'CLI for Railroad\AddEventManager';

    public function handle()
    {
        $this->info('foo');

        $stopHere = true;
    }
}
