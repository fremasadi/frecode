<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'hero_description',
        'profile_image',
        'about_description',
        'about_description_2',
        'years_experience',
        'projects_completed',
        'happy_clients',
        'email',
        'phone',
        'location',
        'availability_status',
        'cv_file',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
    ];

    /**
     * Get the profile image URL
     */
    public function getProfileImageUrlAttribute(): ?string
    {
        if (!$this->profile_image) {
            return null;
        }
        return Storage::url($this->profile_image);
    }

    /**
     * Get the CV file URL
     */
    public function getCvFileUrlAttribute(): ?string
    {
        if (!$this->cv_file) {
            return null;
        }
        return Storage::url($this->cv_file);
    }

    /**
     * Get the first (or only) profile
     */
    public static function getProfile(): ?static
    {
        return static::first();
    }
}
