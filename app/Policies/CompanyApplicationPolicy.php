<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\CompanyApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any company applications.
     *
     * @param User $user
     * @param Company $company
     * @return Response
     */
    public function viewAny(User $user, Company $company): Response
    {
        // Check if the user owns the company
        if ($company->isOwnedByUser()) {
            return Response::allow();
        }

        // Check if the user has an application attached to the company
        if ($user->companyApplications()->where('company_id', $company->id)->exists()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view the applications of this company.');
    }

    /**
     * Determine whether the user can view the company application.
     *
     * @param User $user
     * @param CompanyApplication $companyApplication
     * @return Response
     */
    public function view(User $user, CompanyApplication $companyApplication): Response
    {
        // Check if the user created the application
        if ($user->id === $companyApplication->applicant_id) {
            return Response::allow();
        }

        // Check if the user owns the company
        if ($companyApplication->company->isOwnedByUser()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this application.');
    }

    /**
     * Determine whether the user can create company applications.
     *
     * @param User $user
     * @param Company $company
     * @return Response
     */
    public function create(User $user, Company $company): Response
    {
        // Check if the company is recruiting
        if (!$company->recruitment_open) {
            return Response::deny('This company is currently not recruiting.');
        }

        // Check if the user is already in a company
        if ($user->company_id) {
            return Response::deny('You are already in a company.');
        }

        // Check if the user has any open applications
        if ($user->companyApplications()->openApplications()->exists()) {
            return Response::deny('You already have an unhandled application for a company.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the company application.
     *
     * @param User $user
     * @param CompanyApplication $companyApplication
     * @return Response
     */
    public function update(User $user, CompanyApplication $companyApplication): Response
    {
        // Check if the user owns the company
        if (!$companyApplication->company->isOwnedByUser()) {
            return Response::deny('You cannot update applications of a company that you do not own.');
        }

        // Check if the user claimed the application
        if ($user->id !== $companyApplication->staff_id) {
            return Response::deny('You must claim this application before you can manage it.');
        }

        return Response::allow();
    }
}
