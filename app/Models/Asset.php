<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_number',
        'category_id',
        'purchase_date',
        'purchase_cost',
        'status',
        'condition',
        'location',
        'assigned_to',
        'assigned_date',
        'warranty_expiry',
        'notes'
    ];

    // Add this relationship
    public function assignedEmployee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    // Add this relationship for assignment history
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Existing category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}