<?php

namespace App\Models;

use App\Casts\Doctor\ProfileImageCast;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property mixed $name
 * @property mixed $surname
 * @property mixed $father_name
 */
class Doctor extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, InteractsWithMedia;

    protected array $cascadeDeletes = ['socials'];

    protected $fillable = [
        'name',
        'surname',
        'father_name',
        'birthday',
        'profession',
        'short_about',
        'about',
        'phone',
        'email',
        'location',
//        'logo',
    ];

    protected $casts = [
        'profile_image' => ProfileImageCast::class
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

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
