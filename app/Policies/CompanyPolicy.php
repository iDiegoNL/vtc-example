<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any companies.
     * The `user` param here is made nullable, so that guests are also allowed to view companies.
     *
     * @param User|null $user
     * @return Response
     */
    public function viewAny(?User $user): Response
    {
        // Users & guests are always allowed to view any company
        return Response::allow();
    }

    /**
     * Determine whether the user can view the company.
     * The `user` param here is made nullable, so that guests are also allowed to view a company.
     *
     * @param User|null $user
     * @param Company $company
     * @return Response
     */
    public function view(?User $user, Company $company): Response
    {
        // Users & guests are always allowed to view a company
        return Response::allow();
    }

    /**
     * Determine whether the user can view the company members.
     * The `user` param here is made nullable, so that guests are also allowed to view company members.
     *
     * @param User|null $user
     * @param Company $company
     * @return bool
     */
    public function viewMembers(?User $user, Company $company): bool
    {
        return $company->display_members;
    }

    /**
     * Determine whether the user can create a company.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        //
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param User $user
     * @param Company $company
     * @return Response
     */
    public function update(User $user, Company $company): Response
    {
        //
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param User $user
     * @param Company $company
     * @return Response
     */
    public function delete(User $user, Company $company): Response
    {
        //
    }

    /**
     * Determine whether the user can leave the company.
     *
     * @param User $user
     * @param Company $company
     * @return Response
     */
    public function leave(User $user, Company $company): Response
    {
        // Check if the user is in the company
        if ($user->company_id !== $company->id) {
            return Response::deny('You cannot leave a company you are not a member of.');
        }

        // Check if the user is the owner of the company
        if ($company->owner_id === $user->id) {
            return Response::deny('You cannot leave a company you are the owner of.');
        }

        return Response::allow();
    }
}
