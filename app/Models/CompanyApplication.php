<?php

namespace App\Models;

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
}
