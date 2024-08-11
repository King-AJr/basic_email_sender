<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $casts = [
        'xray' => 'array',
        'ultrasound' => 'array',
        'ct_scan' => 'array',
        'mri' => 'array',
    ];

    protected $guarded = [];
}
