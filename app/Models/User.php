<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the company the user is in.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user's company applications.
     */
    public function companyApplications(): HasMany
    {
        return $this->hasMany(CompanyApplication::class, 'applicant_id');
    }

    /**
     * Get the user's claimed company applications.
     */
    public function claimedCompanyApplications(): HasMany
    {
        return $this->hasMany(CompanyApplication::class, 'staff_id');
    }

    /**
     * Get the user's event requests.
     */
    public function eventRequests(): HasMany
    {
        return $this->hasMany(EventRequest::class, 'requester_id');
    }

    /**
     * Get the user's claimed event requests.
     */
    public function claimedEventRequests(): HasMany
    {
        return $this->hasMany(EventRequest::class, 'staff_id');
    }
}
