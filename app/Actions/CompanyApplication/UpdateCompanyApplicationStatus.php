<?php

namespace App\Actions\CompanyApplication;

use App\Models\CompanyApplication;
use Throwable;

class UpdateCompanyApplicationStatus
{
    /**
     * @param CompanyApplication $application
     * @param string $status
     * @return CompanyApplication
     * @throws Throwable
     */
    public function execute(CompanyApplication $application, string $status): CompanyApplication
    {
        // Update the application status
        $application->updateOrFail([
            'status' => $status,
        ]);

        // Perform any status-specific actions
        match ($status) {
            'hired' => $this->hireApplicant($application),
            'declined', 'cancelled' => $this->closeApplication($application),
            default => null, // Do nothing if the above statuses don't match
        };

        return $application->fresh();
    }

    private function hireApplicant(CompanyApplication $application): void
    {
        $this->closeApplication($application);

        $application->applicant()->update([
            'company_id' => $application->company_id,
        ]);
    }

    private function closeApplication(CompanyApplication $application): void
    {
        $application->update(['closed_at' => now()]);
    }
}
