<?php

namespace App\Http\Controllers;

use App\Actions\CompanyApplication\AssignCompanyApplicationAction;
use App\Actions\CompanyApplication\CreateCompanyApplicationAction;
use App\Actions\CompanyApplication\SubmitCompanyApplicationCommentAction;
use App\Http\Requests\AssignCompanyApplicationRequest;
use App\Http\Requests\StoreCompanyApplicationCommentRequest;
use App\Http\Requests\StoreCompanyApplicationRequest;
use App\Http\Requests\UpdateCompanyApplicationRequest;
use App\Models\Company;
use App\Models\CompanyApplication;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CompanyApplicationResourceController extends Controller
{
    private CreateCompanyApplicationAction $createCompanyApplicationAction;
    private AssignCompanyApplicationAction $assignCompanyApplicationAction;
    private SubmitCompanyApplicationCommentAction $submitCompanyApplicationCommentAction;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(
        CreateCompanyApplicationAction        $createCompanyApplicationAction,
        AssignCompanyApplicationAction        $assignCompanyApplicationAction,
        SubmitCompanyApplicationCommentAction $submitCompanyApplicationCommentAction
    )
    {
        $this->middleware('auth');

        $this->createCompanyApplicationAction = $createCompanyApplicationAction;
        $this->assignCompanyApplicationAction = $assignCompanyApplicationAction;
        $this->submitCompanyApplicationCommentAction = $submitCompanyApplicationCommentAction;
    }

    /**
     * Display a listing of the company applications.
     *
     * @param Company $company
     * @return View
     * @throws AuthorizationException
     */
    public function index(Company $company): View
    {
        $this->authorize('viewAny', [CompanyApplication::class, $company]);

        // Query all applications for the given company if the authenticated user owns it.
        // Otherwise, just query the authenticated user's applications for this company.
        if ($company->isOwnedByUser()) {
            $applications = $company->applications()->paginate(25);
        } else {
            $applications = $company->applications()
                ->whereRelation('applicant', 'id', Auth::id())
                ->paginate(25);
        }

        return view('companies.applications.index', ['company' => $company, 'applications' => $applications]);
    }

    /**
     * Store a newly created company application in storage.
     *
     * @param StoreCompanyApplicationRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function store(StoreCompanyApplicationRequest $request, Company $company): RedirectResponse
    {
        $application = $this->createCompanyApplicationAction->execute($request->user(), $company, $request->validated());

        return redirect()->route('vtc.applications.show', [$company->id, $application->id]);
    }

    /**
     * Display the specified company application.
     *
     * @param Company $company
     * @param CompanyApplication $companyApplication
     * @return View
     * @throws AuthorizationException
     */
    public function show(Company $company, CompanyApplication $companyApplication): View
    {
        $companyApplication->load([
            'applicant',
            'claimedBy',
            'comments',
            'comments.user'
        ]);

        $this->authorize('view', $companyApplication);

        return view('companies.applications.show', ['company' => $company, 'application' => $companyApplication]);
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
     * (Re)assign the specified company application.
     *
     * @param AssignCompanyApplicationRequest $request
     * @param Company $company
     * @param CompanyApplication $companyApplication
     * @return RedirectResponse
     */
    public function assign(AssignCompanyApplicationRequest $request, Company $company, CompanyApplication $companyApplication): RedirectResponse
    {
        $this->assignCompanyApplicationAction->execute($companyApplication, $request->user());

        return redirect()->back();
    }

    /**
     * Comment on the specified company application.
     *
     * @param StoreCompanyApplicationCommentRequest $request
     * @param Company $company
     * @param CompanyApplication $companyApplication
     * @return RedirectResponse
     */
    public function comment(StoreCompanyApplicationCommentRequest $request, Company $company, CompanyApplication $companyApplication): RedirectResponse
    {
        $this->submitCompanyApplicationCommentAction->execute($companyApplication, $request->user(), $request->validated()['comment']);

        return redirect()->back();
    }
}
