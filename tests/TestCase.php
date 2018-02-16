<?php

/*
 * This file is part of the tenancy/tenancy package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see http://laravel-tenancy.com
 * @see https://github.com/tenancy
 */

namespace Tenancy\Tests;

use Illuminate\Foundation\Testing\TestCase as Test;

class TestCase extends Test
{
    use Concerns\CreatesApplication;

    protected function afterSetUp()
    {
        // ..
    }

    protected function beforeTearDown()
    {
        // ..
    }

    protected function setUp()
    {
        parent::setUp();

        $this->afterSetUp();
    }

    protected function tearDown()
    {
        $this->beforeTearDown();

        parent::tearDown();
    }
}
