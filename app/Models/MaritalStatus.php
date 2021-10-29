<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $observables = [
        'listed',
        'retrieved',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function logListed()
    {
        $this->fireModelEvent('listed', false);
    }

    public function logViewed()
    {
        $this->fireModelEvent('retrieved', false);
    }
}
