<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    protected $fillable = [
        'employee_id',
        'department_id',
        'full_name',
        'purpose',
        'activity_date',
        'expenses',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'expenses' => 'array',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
