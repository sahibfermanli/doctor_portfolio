<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 * @property mixed $surname
 * @property mixed $father_name
 */
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


    public function fullname($with_father_name = false): string
    {
        return $with_father_name
            ? $this->name . ' ' . $this->surname . ' ' . $this->father_name
            : $this->name . ' ' . $this->surname;
    }

    public function socials(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(EducationalQualification::class);
    }
}
