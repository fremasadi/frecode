<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'detail',
        'images',
        'categories',
        'technologies',
        'demo_url',
        'github_url',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'images' => 'array',
        'categories' => 'array',
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    /**
     * Get the first image URL (for card thumbnail)
     */
    public function getFirstImageUrlAttribute(): ?string
    {
        $images = $this->images ?? [];
        if (empty($images)) {
            return null;
        }
        return Storage::url($images[0]);
    }

    /**
     * Get all image URLs
     */
    public function getImageUrlsAttribute(): array
    {
        $images = $this->images ?? [];
        return array_map(fn($image) => Storage::url($image), $images);
    }

    /**
     * Scope to get only active projects
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only featured projects
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to filter by category (checks if category exists in categories array)
     */
    public function scopeCategory($query, string $category)
    {
        return $query->whereJsonContains('categories', $category);
    }

    /**
     * Check if project has a specific category
     */
    public function hasCategory(string $category): bool
    {
        return in_array($category, $this->categories ?? []);
    }

    /**
     * Scope to order by the order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
