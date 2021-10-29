<?php

namespace App\Observers;

use App\CustomClasses\SgcLogger;
use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__, model: $role);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updating(Role $role)
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__, model: $role);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__, model: $role);
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__, model: $role);
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }

    public function listed()
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__);
    }

    public function fetched(Role $approved)
    {
        SgcLogger::writeLog(target: 'Role', action: __FUNCTION__, model: $approved);
    }
}
