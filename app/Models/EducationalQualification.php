<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'degree',
        'university',
        'university_short',
        'section',
        'city_country',
        'description',
        'start_date',
        'end_date',
    ];
}
