<?php

namespace App\Actions\CompanyApplication;

use App\Models\Company;
use App\Models\CompanyApplication;
use App\Models\User;

class CreateCompanyApplicationAction
{
    /**
     * @param User $user
     * @param Company $company
     * @param array $data
     * @return CompanyApplication
     */
    public function execute(User $user, Company $company, array $data): CompanyApplication
    {
        // Create a new application with the request data
        $application = new CompanyApplication($data);

        // Associate the application with the company & user (applicant)
        $application->company()->associate($company);
        $application->applicant()->associate($user);

        $application->save();

        return $application->fresh();
    }
}
