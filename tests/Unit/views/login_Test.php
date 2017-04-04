<?php

namespace Tests\Unit;

use Tests\TestCase;
use Symfony\Component\DomCrawler\Crawler;

use View;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItShouldDisplayLoginForm()
    {
        $html    = View::make("auth.login_page")->render();
        $crawler = new Crawler($html);

        $this->assertEquals(1, $crawler->filter('input[name="username"][type="text"]')->count());
        $this->assertEquals(1, $crawler->filter('input[name="password"][type="password"]')->count());
    }
}
