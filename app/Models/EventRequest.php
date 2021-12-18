<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class EventRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'requester_id',
        'staff_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_hidden' => 'boolean',
        'enable_afk_kick' => 'boolean',
        'enable_speed_limit' => 'boolean',
        'enable_player_collisions' => 'boolean',
        'enable_cars_for_players' => 'boolean',
        'enable_live_map' => 'boolean',
        'enable_promods' => 'boolean',
    ];

    /**
     * Get the user that created the event request.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff user that claimed the event request.
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the event request's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the event request's most recent comment.
     */
    public function latestComment(): MorphOne
    {
        return $this->morphOne(Comment::class, 'commentable')->latestOfMany();
    }

    /**
     * Scope a query to only include user's requested events.
     *
     * @param Builder $query
     * @return Builder|null
     */
    public function scopePersonal(Builder $query): Builder|null
    {
        // Return null if the user is not logged in
        if (!Auth::check()) {
            return null;
        }

        return $query->where('requester_id', Auth::id());
    }

    /**
     * Check if the chosen event request is handled (accepted or declined).
     *
     * @return bool
     */
    public function isHandled(): bool
    {
        return in_array($this->status, ['accepted', 'declined']);
    }
}
