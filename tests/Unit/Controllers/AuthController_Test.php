<?php
namespace Tests\Unit\Controllers;

use Tests\Unit\Controllers\ControllerTest;

class AuthController_Test extends ControllerTest
{
    public function testLoginPageWillShown()
    {
        $response = $this->sendRequest("get", 'login_page');

        $response->assertStatus(200);
        $this->assertViewOnResponseIs('auth.login_page', $response);
    }
}
