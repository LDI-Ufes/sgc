<?php

namespace App\Observers;

use App\Helpers\SgcLogHelper;
use App\Models\Bond;

class BondObserver
{
    /**
     * Handle the Bond "created" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function created(Bond $bond)
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__, model_json: $bond->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Bond "updated" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function updating(Bond $bond)
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__, model_json: json_encode($bond->getOriginal(), JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Bond "updated" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function updated(Bond $bond)
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__, model_json: $bond->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Bond "deleted" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function deleted(Bond $bond)
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__, model_json: $bond->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the Bond "restored" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function restored(Bond $bond)
    {
        //
    }

    /**
     * Handle the Bond "force deleted" event.
     *
     * @param  \App\Models\Bond  $bond
     * @return void
     */
    public function forceDeleted(Bond $bond)
    {
        //
    }

    public function listed()
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__);
    }

    public function fetched(Bond $bond)
    {
        SgcLogHelper::writeLog(target: 'Bond', action: __FUNCTION__, model_json: $bond->toJson(JSON_UNESCAPED_UNICODE));
    }
}
