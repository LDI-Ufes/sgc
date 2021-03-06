<?php

namespace App\Observers;

use App\Helpers\SgcLogHelper;
use App\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__, model_json: $employee->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updating(Employee $employee)
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__, model_json: json_encode($employee->getOriginal(), JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__, model_json: $employee->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__, model_json: $employee->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }

    public function listed()
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__);
    }

    public function fetched(Employee $employee)
    {
        SgcLogHelper::writeLog(target: 'Employee', action: __FUNCTION__, model_json: $employee->toJson(JSON_UNESCAPED_UNICODE));
    }
}
