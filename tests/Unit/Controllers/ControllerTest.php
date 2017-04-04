<?php
namespace Tests\Unit\Controllers;

use Tests\TestCase;

class ControllerTest extends TestCase
{
    protected function sendRequest($httpMethod, $routeName, $params = []) {
        $path = route($routeName, $params);
        return $this->call($httpMethod, $path);
    }
}

