<?php

namespace Chitranu\GoogleRecaptcha\Tests;

use Orchestra\Testbench\TestCase;
use Chitranu\GoogleRecaptcha\GoogleRecaptchaServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [GoogleRecaptchaServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
