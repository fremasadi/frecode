<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Experience extends Model
{
    protected $fillable = [
        'position',
        'company',
        'description',
        'technologies',
        'start_date',
        'end_date',
        'is_current',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'technologies' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get formatted date range
     */
    public function getDateRangeAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end = $this->is_current || !$this->end_date ? 'Present' : $this->end_date->format('M Y');
        return "{$start} - {$end}";
    }

    /**
     * Get duration in years and months
     */
    public function getDurationAttribute(): string
    {
        $end = $this->is_current || !$this->end_date ? Carbon::now() : $this->end_date;
        $diff = $this->start_date->diff($end);

        $parts = [];
        if ($diff->y > 0) {
            $parts[] = $diff->y . ' ' . ($diff->y === 1 ? 'year' : 'years');
        }
        if ($diff->m > 0) {
            $parts[] = $diff->m . ' ' . ($diff->m === 1 ? 'month' : 'months');
        }

        return implode(' ', $parts) ?: 'Less than a month';
    }

    /**
     * Scope to get only active experiences
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by the order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope to order by date (newest first)
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('start_date', 'desc');
    }
}
