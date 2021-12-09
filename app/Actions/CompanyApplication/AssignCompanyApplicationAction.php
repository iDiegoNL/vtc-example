<?php

namespace App\Actions\CompanyApplication;

use App\Models\CompanyApplication;
use App\Models\User;

class AssignCompanyApplicationAction
{
    /**
     * @param CompanyApplication $application
     * @param User $user
     * @return CompanyApplication
     */
    public function execute(CompanyApplication $application, User $user): CompanyApplication
    {
        // Associate the (staff) user with the application
        $application->claimedBy()->associate($user);

        // Save the application
        $application->save();

        return $application->fresh();
    }
}
