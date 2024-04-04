<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_redirects_dashboard_after_login()
    {
        // Values to input for login
        $testEmployeeID = '1';
        $testPassword = '636Nxq';

        // Input values into route and session
        $response = $this->post(route('login.post'), [
            'employeeID'=>$testEmployeeID,
            'password'=>$testPassword
        ]);

        // Check if session is created & redirected to the right screen
        $response->assertRedirect(route('home'));

    }
}
