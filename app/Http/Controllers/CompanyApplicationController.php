<?php

namespace App\Http\Controllers;

use App\Actions\CompanyApplication\CreateCompanyApplicationAction;
use App\Http\Requests\StoreCompanyApplicationRequest;
use App\Http\Requests\UpdateCompanyApplicationRequest;
use App\Models\Company;
use App\Models\CompanyApplication;
use Illuminate\Http\RedirectResponse;

class CompanyApplicationController extends Controller
{
    private CreateCompanyApplicationAction $createCompanyApplicationAction;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(CreateCompanyApplicationAction $createCompanyApplicationAction)
    {
        $this->createCompanyApplicationAction = $createCompanyApplicationAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyApplicationRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function store(StoreCompanyApplicationRequest $request, Company $company)
    {
        $application = $this->createCompanyApplicationAction->execute($request->user(), $company, $request->validated());

        return redirect()->route('vtc.applications.show', [$company->id, $application->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param CompanyApplication $companyApplication
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyApplication $companyApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CompanyApplication $companyApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyApplication $companyApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyApplicationRequest $request
     * @param CompanyApplication $companyApplication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyApplicationRequest $request, CompanyApplication $companyApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CompanyApplication $companyApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyApplication $companyApplication)
    {
        //
    }
}
