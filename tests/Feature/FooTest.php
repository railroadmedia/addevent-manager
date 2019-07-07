<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FooTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        Artisan::call('addevent', array());

        $output = Artisan::output();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
