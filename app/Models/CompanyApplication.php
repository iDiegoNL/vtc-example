<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'applicant_id',
        'staff_id',
        'description',
        'status',
        'closed_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'closed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the application.
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company the user applied to.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that claimed the application.
     */
    public function claimedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Scope a query to only include open (unhandled) applications.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOpenApplications(Builder $query): Builder
    {
        return $query->whereIn('status', ['new', 'in progress']);
    }
}
