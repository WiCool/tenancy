<?php

namespace Tenancy\Database\Listeners;

use Tenancy\Tenant\Events\Updated;

class AutoUpdating extends DatabaseMutation
{
    public function handle(Updated $updated)
    {
        if ($this->driver && config('tenancy.db.auto-update')) {

        }
    }
}
