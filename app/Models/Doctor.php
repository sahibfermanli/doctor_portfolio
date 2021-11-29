<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['socials'];

    protected $fillable = [
        'name',
        'surname',
        'father_name',
        'birthday',
        'image',
    ];

    public function socials(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}
