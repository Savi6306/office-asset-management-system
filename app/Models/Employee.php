<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'email',
        'phone',
        'department',
        'position',
        'hire_date',
        'status',
        'address'
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];

    // Relationship with assets (through assignments)
    public function assets()
    {
        return $this->hasMany(Asset::class, 'assigned_to');
    }

    // Relationship with assignments history
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}