<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_id',
        'department',
        'designation',
        'phone',
        'address',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean'
    ];

    // Relationship with assignments (assets assigned to user)
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Get current assignments (active or overdue)
    public function getCurrentAssignmentsAttribute()
    {
        return $this->assignments()
            ->whereIn('assignment_status', ['active', 'overdue'])
            ->with('asset')
            ->get();
    }

    // Get assigned assets
    public function assignedAssets()
    {
        return $this->belongsToMany(Asset::class, 'assignments')
            ->withPivot('assigned_date', 'expected_return_date', 'assignment_status')
            ->withTimestamps();
    }

    // Relationship with assets added by user
    public function addedAssets()
    {
        return $this->hasMany(Asset::class, 'added_by');
    }

    // Check if user has active assignments
    public function getHasActiveAssignmentsAttribute()
    {
        return $this->assignments()
            ->whereIn('assignment_status', ['active', 'overdue'])
            ->exists();
    }

    // Count of current assignments
    public function getCurrentAssignmentsCountAttribute()
    {
        return $this->assignments()
            ->whereIn('assignment_status', ['active', 'overdue'])
            ->count();
    }
}