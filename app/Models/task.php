<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $casts=[
        'is_done'=> 'boolean',
    ];

    protected $hidden=[
        'updated_at',
    ];
}
