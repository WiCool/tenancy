<?php

namespace Tenancy\Database\Listeners;

use Tenancy\Tenant\Events\Deleted;

class AutoDeletion extends DatabaseMutation
{
    public function handle(Deleted $deleted)
    {
        if ($this->driver && config('tenancy.db.auto-delete')) {
            return $this->driver->delete($deleted->tenant);
        }

        return [];
    }
}
