<?php

namespace App\Actions\User;

use App\Models\User;
use Throwable;

class LeaveCompanyAction
{
    /**
     * Set the user's company ID to null, thus leaving it.
     *
     * @param User $user
     * @return User
     * @throws Throwable
     */
    public function execute(User $user): User
    {
        $user->company_id = null;

        $user->saveOrFail();

        return $user->fresh();
    }
}
