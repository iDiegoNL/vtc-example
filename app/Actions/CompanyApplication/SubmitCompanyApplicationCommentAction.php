<?php

namespace App\Actions\CompanyApplication;

use App\Models\Comment;
use App\Models\CompanyApplication;
use App\Models\User;

class SubmitCompanyApplicationCommentAction
{
    /**
     * @param CompanyApplication $application
     * @param User $user
     * @param string $comment
     * @return Comment
     */
    public function execute(CompanyApplication $application, User $user, string $comment): Comment
    {
        // Create a new comment for the application
        return $application->comments()->create([
            'user_id' => $user->id,
            'comment' => $comment,
        ]);
    }
}
