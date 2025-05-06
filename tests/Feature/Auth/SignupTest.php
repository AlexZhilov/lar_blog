<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use DatabaseTransactions;

    public function test_signup_page_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_user_can_register_using_the_register_screen()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test1232sa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        // проверяем, что неактивен
        $this->assertFalse(auth()->user()->isActive());
        // имеет роль user
        $this->assertTrue(auth()->user()->hasRole('user'));

        $response->assertRedirect('/');
    }
}
