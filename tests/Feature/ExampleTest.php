<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /*
     * Define the test case for post request of api
     */
    public function test_post_appointment_api_request()
    {
        $response = $this->postJson('/api/appointments', ['schedule_date' => '2022-09-26', 'schedule_start_time' => '13:30:00', 'schedule_end_time' => '15:30:00', 'user_id' => '1,1', 'shop_id' => '1', 'service_id' => '1', ]);

        $response
            ->assertStatus(200);
    }
}
