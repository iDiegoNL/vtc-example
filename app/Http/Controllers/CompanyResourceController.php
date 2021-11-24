<?php

namespace App\Http\Controllers;

use App\Actions\User\LeaveCompanyAction;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class CompanyResourceController extends Controller
{
    private LeaveCompanyAction $leaveCompanyAction;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(LeaveCompanyAction $leaveCompanyAction)
    {
        // Attach the CompanyPolicy methods to the controller resource methods
        $this->authorizeResource(Company::class, 'company');

        $this->leaveCompanyAction = $leaveCompanyAction;
    }

    /**
     * Display a listing of the companies.
     *
     * @return View
     */
    public function index(): View
    {
        $companies = Company::all();

        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new company.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created company in storage.
     *
     * @param \App\Http\Requests\StoreCompanyRequest $request
     * @return Response
     */
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified company.
     *
     * @param Company $company
     * @return View
     */
    public function show(Company $company): View
    {
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified company in storage.
     *
     * @param \App\Http\Requests\UpdateCompanyRequest $request
     * @param Company $company
     * @return Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified company from storage.
     *
     * @param Company $company
     * @return Response
     */
    public function destroy(Company $company)
    {
        //
    }

    /**
     * Leave the company.
     *
     * @param Company $company
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function leave(Company $company): RedirectResponse
    {
        // Check if the user is authorized to leave the company
        $this->authorize('leave', $company);

        $this->leaveCompanyAction->execute(Auth::user());

        return back();
    }
}
