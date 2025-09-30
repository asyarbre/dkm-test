<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'employee_id',
        'full_name',
        'purpose',
        'activity_date',
    ];
}
