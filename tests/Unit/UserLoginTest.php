<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class UserLoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_screen_can_be_rendered()
	{

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {

        $response = $this->post('/login', [
			'email' => 'user1@user1.com',
            'password' => 'wordpass',

        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('/referrals');

    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        
		$response = $this->post('/login', [
            'email' => 'user1@user1.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/');

    }
    public function test_already_registered_user()
    {
    	$response = $this->assertDatabaseHas('users', [
    		'email' => 'user1@user1.com',
    	]);
 		$response->get('/referrals');   	
    	
    }

    public function test_already_invited_user()
    {
    	$response = $this->assertDatabaseHas('referral_links', [
    		'referral_email' => 'abc@abc.com',
    	]);

 		$response->get('/referrals');   	
    	
    }

    
}
