<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\ModelFilters\UserFilter;
use Carbon\Carbon;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use InvalidArgumentException;
use Kyslik\ColumnSortable\Sortable;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class User extends Authenticatable
{
    use /* HasApiTokens, */HasFactory, Notifiable;
    use Sortable;
    use UserFilter, Filterable;

    public $sortable = ['id', 'email', 'active', 'created_at', 'updated_at'];
    public static $accepted_filters = [
        'emailContains',
        // 'usertypeNameContains',
        'activeExactly',
        'employeeNameContains',
        'employeeId',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        //'name',
        'email',
        'password',
        'active',
    ];

    protected $observables = [
        'listed',
        'fetched',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private static $whiteListFilter = ['*'];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function userTypeAssignments($options = [])
    {
        return $this->hasMany(UserTypeAssignment::class);
    }

    //dynamic > static :)
    public function getActiveUtas()
    {
        return $this->userTypeAssignments()
            ->with('userType', 'course')
            ->join('user_types', 'user_type_assignments.user_type_id', '=', 'user_types.id')
            ->select('user_type_assignments.*')
            ->where(
                function ($query) {
                    $query
                        ->where([
                            ['begin', '<=', Carbon::today()->toDateString()],
                            ['end', '>=', Carbon::today()->toDateString()],
                        ])
                        ->orWhere([
                            ['begin', '<=', Carbon::today()->toDateString()],
                            ['end', '=', null],
                        ]);
                }
            )
            ->orderBy('user_types.name', 'asc');
    }

    public function scopeWhereActiveUserType($query, $id)
    {
        return $query
            ->join('user_type_assignments AS user_type_assignments_A', 'users.id', '=', 'user_type_assignments_A.user_id')
            ->where('user_type_assignments_A.user_type_id', $id)
            ->where(
                function ($query) {
                    $query
                        ->where([
                            ['user_type_assignments_A.begin', '<=', Carbon::today()->toDateString()],
                            ['user_type_assignments_A.end', '>=', Carbon::today()->toDateString()],
                        ])
                        ->orWhere([
                            ['user_type_assignments_A.begin', '<=', Carbon::today()->toDateString()],
                            ['user_type_assignments_A.end', '=', null],
                        ]);
                }
            )
            ->select('users.*');
    }

    public function scopeWhereUtaCourseId($query, $id)
    {
        return $query
            ->join('user_type_assignments AS user_type_assignments_B', 'users.id', '=', 'user_type_assignments_B.user_id')
            ->where('user_type_assignments_B.course_id', $id)
            ->select('users.*');
    }

    public function logListed()
    {
        $this->fireModelEvent('listed', false);
    }

    public function logFetched()
    {
        $this->fireModelEvent('fetched', false);
    }

    //permission system

    /**
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function hasUtas(): bool
    {
        return $this->getActiveUtas()->get()->count() > 0;
    }

    /**
     * @return UserTypeAssignment|null
     *
     * @throws InvalidArgumentException
     */
    public function getFirstUta(): ?UserTypeAssignment
    {
        return $this->getActiveUtas()?->first();
    }

    /**
     * @param int|null $user_type_assignment_id
     *
     * @return void
     *
     * @throws InvalidArgumentException
     * @throws ModelNotFoundException
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function setCurrentUta(?int $user_type_assignment_id): void
    {
        if ($user_type_assignment_id) {
            $user_type_assignment = $this
                ->getActiveUtas()
                ->where('user_type_assignments.id', $user_type_assignment_id)
                ->firstOrFail();

            session(['loggedInUser.currentUta' => $user_type_assignment]);
            //session(['loggedInUser.currentUtaId' => $user_type_assignment?->id]);
        } else {
            session(['loggedInUser.currentUta' => null]);
            //session(['loggedInUser.currentUtaId' => null]);
        }
    }

    /**
     * @return UserTypeAssignment|null
     *
     * @throws BindingResolutionException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function getCurrentUta(): ?UserTypeAssignment
    {
        /* $user_type_assignment = $this
            ->getActiveUtas()
            ->where('user_type_assignments.id', session('loggedInUser.currentUtaId'))
            ->first();

        return $user_type_assignment; */

        return session('loggedInUser.currentUta');
    }

    /**
     * Get the user's name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->employee ? $this->employee->name : $this->email,
        );
    }

    /**
     * Get the user's gender article.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function genderArticle(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->employee ? ($this->employee->gender ? ($this->employee->gender->name === 'Masculino' ? 'o' : 'a') : 'o(a)') : 'o(a)',
        );
    }
}
