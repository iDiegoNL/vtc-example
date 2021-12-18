<?php /** @var App\Models\Comment $comment */ ?>

@props([
    'comment',
])

<div class="comment">
    <h3>
        <span class="badge" style="background-color: {{ $comment->user->roles->first()->color }}; font-weight: bold;">
            {{ ucwords($comment->user->roles->first()->name) }}
        </span>
        <a href="#" style="color: {{ $comment->user->roles->first()->color }}" class="">{{ $comment->user->name }}</a>
        at {{ $comment->created_at }}
    </h3>
    <p class="autolink">
        <x-safe-text :text="$comment->comment"/>
    </p>
</div>
