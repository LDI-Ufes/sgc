<?php

namespace App\Gates;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GenericGates
{
    public static function define()
    {
        /* define a system admin user role */
        Gate::define('isAdm', function ($user) {
            return self::checkGenericRoleUta('adm');
        });

        /* define a director user role */
        Gate::define('isDir', function ($user) {
            return self::checkGenericRoleUta('dir');
        });

        /* define a grantor assistant user role */
        Gate::define('isAss', function ($user) {
            return self::checkGenericRoleUta('ass');
        });

        /* define a academic secretary user role */
        Gate::define('isSec', function ($user) {
            return self::checkGenericRoleUta('sec');
        });

        /* define a ldi user role */
        Gate::define('isLdi', function ($user) {
            return self::checkGenericRoleUta('ldi');
        });

        /* define a grantee user role */
        Gate::define('isCoord', function ($user) {
            return self::checkGenericRoleUta('coord');
        });

        /* define a system admin user role */
        Gate::define('isAdm-global', function (User $user) {
            return self::checkGlobalRoleUta('adm');
        });

        /* define a system diretor user role */
        Gate::define('isDir-global', function (User $user) {
            return self::checkGlobalRoleUta('dir');
        });

        /* define a system Assistant user role */
        Gate::define('isAss-global', function (User $user) {
            return self::checkGlobalRoleUta('ass');
        });

        /* define a system sec user role */
        Gate::define('isSec-global', function (User $user) {
            return self::checkGlobalRoleUta('sec');
        });

        /* define a grantee user role */
        Gate::define('isCoord-global', function (User $user) {
            return self::checkGlobalRoleUta('coord');
        });

        /* define a grantee user role */
        Gate::define('isLdi-global', function (User $user) {
            return self::checkGlobalRoleUta('ldi');
        });

        /* define a coord with course_id */
        Gate::define('isCoord-course_id', function (User $user, int $course_id) {
            //need to have session UserTypeAssignment active.
            $currentUTA = auth()->user()->getCurrentUta();
            if (! $currentUTA) {
                return false;
            }

            //if currentUTA (UserTypeAssignment) is coord, ok
            $is_coord = $currentUTA->userType->acronym === 'coord';

            // Issue #36: For some reason, sometimes $course_id isn't integer, but string... Fixed with typed parameter.
            $course_id_match = $currentUTA->course_id === $course_id;
            if ($is_coord && $course_id_match) {
                return true;
            }

            //if no permission
            return false;
        });
    }
    private static function checkGenericRoleUta(string $acronym): bool
    {
        //return $user->userType->acronym == $acronym;

        //need to have session UserTypeAssignment active.
        $currentUTA = auth()->user()->getCurrentUta();
        if (! $currentUTA) {
            return false;
        }

        //if currentUTA (UserTypeAssignment) is $acronym, ok
        $acronymMatch = $currentUTA->userType->acronym === $acronym;
        if ($acronymMatch) {
            return true;
        }

        //if no permission
        return false;
    }

    private static function checkGlobalRoleUta(string $acronym): bool
    {
        //need to have session UserTypeAssignment active.
        $currentUTA = auth()->user()->getCurrentUta();
        if (! $currentUTA) {
            return false;
        }

        //if currentUTA (UserTypeAssignment) is $acronym, ok
        $acronymMatch = $currentUTA->userType->acronym === $acronym;
        $course_id_null = $currentUTA->course_id === null;
        if ($acronymMatch && $course_id_null) {
            return true;
        }

        //if no permission
        return false;
    }
}
