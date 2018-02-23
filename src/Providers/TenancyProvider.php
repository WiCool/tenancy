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

namespace Tenancy\Providers;

use Illuminate\Support\ServiceProvider;
use Tenancy\Environment;

class TenancyProvider extends ServiceProvider
{
    use Provides\ProvidesConfig,
        Provides\ProvidesMiddleware,
        Provides\ProvidesMigrations,
        Provides\ProvidesServices,
        Provides\ProvidesEloquentConnections;

    protected $defer = true;

    public $singletons = [
        Environment::class => Environment::class
    ];

    public function register()
    {
        $this->bootTenantTraits();
    }

    protected function bootTenantTraits()
    {
        $class = static::class;

        foreach (class_uses_recursive($class) as $trait) {
            if (method_exists($class, $method = 'boot'.class_basename($trait))) {
                call_user_func([$this, $method]);
            }
            if (method_exists($class, $method = 'servicesOf'.class_basename($trait))) {
                $this->providesServices = array_merge($this->providesServices, call_user_func([$this, $method]));
            }
        }
    }
}