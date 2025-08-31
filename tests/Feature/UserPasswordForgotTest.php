<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class UserPasswordForgotTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_password_forgot_returns_a_successful_response(): void
    {
        $response = $this->get('/users/password/new');

        $response->assertStatus(200);
    }
}
