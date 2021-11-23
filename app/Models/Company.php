<?php

namespace App\Models;

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
     * Get the users that are in the company.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
