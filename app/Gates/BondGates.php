<?php

namespace App\Gates;

use Illuminate\Support\Facades\Gate;

class BondGates
{
    public static function define()
    {
        Gate::define('bond-list', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global', 'isSec-global'])) {
                return true;
            }

            //coord on any course
            if (Gate::forUser($user)->any(['isCoord'])) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-show', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global', 'isSec-global'])) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-create', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global', 'isSec-global'])) {
                return true;
            }

            //coord on any course
            if (Gate::forUser($user)->any(['isCoord'])) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-store-course_id', function ($user, $course_id) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global', 'isSec-global'])) {
                return true;
            }

            //coord on this course then ok.
            if (Gate::forUser($user)->any(['isCoord-course_id'], $course_id)) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-update', function ($user, $bond) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global', 'isSec-global'])) {
                return true;
            }

            //coord on this course then ok.
            if (Gate::forUser($user)->any(['isCoord-course_id'], $bond->course_id)) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-destroy', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global'])) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-requestReview', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isSec-global'])) {
                return true;
            }

            //no permission
            return false;
        });

        Gate::define('bond-review', function ($user) {
            //who can do it (global).
            if (Gate::forUser($user)->any(['isAdm-global', 'isDir-global', 'isAss-global'])) {
                return true;
            }

            //no permission
            return false;
        });
    }
}
