<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthPagesTest extends TestCase
{
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_student_registration_page_loads(): void
    {
        $response = $this->get('/register/student');

        $response->assertStatus(200);
    }

    public function test_lecturer_registration_page_loads(): void
    {
        $response = $this->get('/register/lecturer');

        $response->assertStatus(200);
    }
}
