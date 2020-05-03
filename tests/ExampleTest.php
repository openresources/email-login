<?php

namespace Openresources\EmailLogin\Tests;

use Orchestra\Testbench\TestCase;
use Openresources\EmailLogin\EmailLoginServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [EmailLoginServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
