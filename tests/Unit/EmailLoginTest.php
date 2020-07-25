<?php

namespace Openresources\EmailLogin\Tests\Unit;

use Tests\App\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateEmailLoginFromEmail()
    {

        $user = factory(User::class)->create();

        $this->assertTrue(true);
    }
}
