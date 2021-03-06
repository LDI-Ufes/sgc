<?php

namespace App\Observers;

use App\Helpers\SgcLogHelper;
use App\Models\CourseType;

class CourseTypeObserver
{
    /**
     * Handle the CourseType "created" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function created(CourseType $courseType)
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__, model_json: $courseType->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the CourseType "updated" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function updating(CourseType $courseType)
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__, model_json: json_encode($courseType->getOriginal(), JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the CourseType "updated" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function updated(CourseType $courseType)
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__, model_json: $courseType->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the CourseType "deleted" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function deleted(CourseType $courseType)
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__, model_json: $courseType->toJson(JSON_UNESCAPED_UNICODE));
    }

    /**
     * Handle the CourseType "restored" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function restored(CourseType $courseType)
    {
        //
    }

    /**
     * Handle the CourseType "force deleted" event.
     *
     * @param  \App\Models\CourseType  $courseType
     * @return void
     */
    public function forceDeleted(CourseType $courseType)
    {
        //
    }

    public function listed()
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__);
    }

    public function fetched(CourseType $courseType)
    {
        SgcLogHelper::writeLog(target: 'CourseType', action: __FUNCTION__, model_json: $courseType->toJson(JSON_UNESCAPED_UNICODE));
    }
}
