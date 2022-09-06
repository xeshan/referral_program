<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered()
    {

        $response = $this->get('/register');
        $response->assertStatus(200);

    }

    public function test_new_users_can_register()
    {

        $response = $this->post('/register', [
            'name' => 'abc',
            'email' => 'abc1@abc1.com',
            'password' => 'wordpass',
            'password_confirmation' => 'wordpass',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/referrals');

    }
    public function test_already_exit_users_cannot_register()
    {

        $response = $this->post('/register', [
            'name' => 'abc',
            'email' => 'abc@abc.com',
            'password' => 'wordpass',
            'password_confirmation' => 'wordpass',
        ]);
        
    	$response->assertRedirect('/');
    }

    

}
