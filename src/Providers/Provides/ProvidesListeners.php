<?php

namespace Tenancy\Providers\Provides;

use Illuminate\Support\Facades\Event;
use Tenancy\Tenant\Events as TenantEvents;
use Tenancy\Database\Listeners as Database;

trait ProvidesListeners
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TenantEvents\Created::class => [
            Database\AutoCreation::class,
        ],
        TenantEvents\Updated::class => [
            Database\AutoUpdating::class,
        ],
        TenantEvents\Deleted::class => [
            Database\AutoDeleting::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    public function bootProvidesListeners()
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        foreach ($this->subscribe as $subscriber) {
            Event::subscribe($subscriber);
        }
    }
}
