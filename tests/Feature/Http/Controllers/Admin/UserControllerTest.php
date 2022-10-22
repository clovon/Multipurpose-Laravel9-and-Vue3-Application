<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_save_user_when_the_password_is_less_than_eight_characters()
    {
        $user = ['name' => 'name', 'email' => 'someone@example.com', 'password' => 'pass'];

        $this->post('/api/users', $user);

        $this->assertDatabaseCount('users', 0);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
