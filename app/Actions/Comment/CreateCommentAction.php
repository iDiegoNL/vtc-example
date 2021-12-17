<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CreateCommentAction
{
    /**
     * @param object $model
     * @param User $user
     * @param string $comment
     * @return Comment
     */
    public function execute(object $model, User $user, string $comment): Comment
    {
        // Check if $model is a model
        if (!$model instanceof Model) {
            throw new \InvalidArgumentException('$model must be an instance of Illuminate\Database\Eloquent\Model');
        }

        // Create a new comment for the application
        return $model->comments()->create([
            'user_id' => $user->id,
            'comment' => $comment,
        ]);
    }
}
