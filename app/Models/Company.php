<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tag',
        'slogan',
        'website_url',
        'contact_email',
        'recruitment_open',
        'logo_path',
        'logo_border',
        'cover_image_path',
        'information',
        'rules',
        'requirements',
        'display_members',
        'show_tag',
        'hide_email',
        'receive_emails',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'recruitment_open' => 'boolean',
        'logo_border' => 'boolean',
        'display_members' => 'boolean',
        'show_tag' => 'boolean',
        'hide_email' => 'boolean',
        'receive_emails' => 'boolean',
    ];

    /**
     * Get the user that owns the company.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the members of the company.
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the applications for the company.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(CompanyApplication::class);
    }

    /**
     * Check if the company is owned by the given user.
     * If no user is given, it uses the authenticated user (if any).
     */
    public function isOwnedByUser(User $user = null): bool
    {
        // Use the authenticated user if none is given
        if ($user === null) {
            $user = Auth::user();
        }

        return $this->owner_id === $user?->id;
    }

    /**
     * Check if the user is a member of the company.
     * If no user is given, it uses the authenticated user (if any).
     */
    public function isMember(User $user = null): bool
    {
        // Use the authenticated user if none is given
        if ($user === null) {
            $user = Auth::user();
        }

        return $this->id === $user?->company_id;
    }

    /**
     * Check if the user has any applications for the company.
     */
    public function userHasApplications(User $user = null): bool
    {
        // Use the authenticated user if none is given
        if ($user === null) {
            $user = Auth::user();
        }

        return $user->companyApplications()->where('company_id', $this->id)->exists();
    }
}
