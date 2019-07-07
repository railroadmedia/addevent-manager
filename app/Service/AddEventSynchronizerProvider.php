<?php namespace Railroad\AddEventManager;

use Illuminate\Support\ServiceProvider;
use Railroad\AddEventManager\Console\Commands\Commander;

class AddEventManagerProvider extends ServiceProvider
{
    protected $commands = [
        Commander::class
    ];

    public function register()
    {
        $this->commands($this->commands);
    }
}
