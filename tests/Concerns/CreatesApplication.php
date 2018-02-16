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

namespace Tenancy\Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $appPaths = [];
        $app = null;

        if (getenv('CI_PROJECT_DIR')) {
            $appPaths[] = realpath(getenv('CI_PROJECT_DIR').'/vendor/laravel/laravel');
        }

        $appPaths[] = realpath(__DIR__.'/../../');
        $appPaths[] = realpath(__DIR__.'/../../vendor/laravel/laravel');

        foreach ($appPaths as $path) {
            $path = "$path/bootstrap/app.php";

            if (file_exists($path)) {
                $app = require $path;
                break;
            }
        }

        if (! $app) {
            throw new \RuntimeException('No Laravel bootstrap.php file found, is laravel/laravel installed?');
        }

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
