<?php

namespace App\Http\Controllers;

use App\Actions\Comment\CreateCommentAction;
use App\Actions\EventRequest\ClaimEventRequestAction;
use App\Actions\EventRequest\CreateEventRequestAction;
use App\Actions\EventRequest\UpdateEventRequestStatus;
use App\Http\Requests\StoreEventRequestCommentRequest;
use App\Http\Requests\StoreEventRequestRequest;
use App\Http\Requests\UpdateEventRequestRequest;
use App\Models\EventRequest;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class EventRequestResourceController extends Controller
{
    private CreateEventRequestAction $createEventRequestAction;
    private ClaimEventRequestAction $claimEventRequestAction;
    private CreateCommentAction $createCommentAction;
    private UpdateEventRequestStatus $updateEventRequestStatus;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(
        CreateEventRequestAction $createEventRequestAction,
        ClaimEventRequestAction  $claimEventRequestAction,
        CreateCommentAction      $createCommentAction,
        UpdateEventRequestStatus $updateEventRequestStatus
    )
    {
        $this->middleware('auth');

        $this->createEventRequestAction = $createEventRequestAction;
        $this->claimEventRequestAction = $claimEventRequestAction;
        $this->createCommentAction = $createCommentAction;
        $this->updateEventRequestStatus = $updateEventRequestStatus;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $personalRequests = EventRequest::personal()->get();

        if (Auth::user()?->can('viewAny', EventRequest::class)) {
            $eventRequests = EventRequest::query()
                ->where('status', 'new')
                ->latest()
                ->get();
        }

        return view('event-requests.index', [
            'personalRequests' => $personalRequests,
            'eventRequests' => $eventRequests ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('event-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequestRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEventRequestRequest $request): RedirectResponse
    {
        $eventRequest = $this->createEventRequestAction->execute($request->user(), $request);

        return redirect()->route('event-request.show', $eventRequest->id);
    }

    /**
     * Display the specified resource.
     *
     * @param EventRequest $eventRequest
     * @return View
     * @throws AuthorizationException
     */
    public function show(EventRequest $eventRequest): View
    {
        $eventRequest->load([
            'requester',
            'requester.roles',
            'staff',
            'comments',
            'comments.user',
            'comments.user.roles',
        ]);

        $this->authorize('view', $eventRequest);

        return view('event-requests.show', ['eventRequest' => $eventRequest]);
    }

    /**
     * Update the specified event request status.
     *
     * @param UpdateEventRequestRequest $request
     * @param EventRequest $eventRequest
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateEventRequestRequest $request, EventRequest $eventRequest): RedirectResponse
    {
        // Update the application status
        $this->updateEventRequestStatus->execute($eventRequest, $request->validated()['status']);

        return redirect()->back();
    }

    /**
     * Claim the specified resource.
     *
     * @param EventRequest $eventRequest
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function claim(EventRequest $eventRequest): RedirectResponse
    {
        $this->authorize('claim', $eventRequest);

        $this->claimEventRequestAction->execute($eventRequest, Auth::user());

        return redirect()->route('event-request.show', $eventRequest->id);
    }

    /**
     * Comment on the specified resource.
     *
     * @param StoreEventRequestCommentRequest $request
     * @param EventRequest $eventRequest
     * @return RedirectResponse
     */
    public function comment(StoreEventRequestCommentRequest $request, EventRequest $eventRequest): RedirectResponse
    {
        $this->createCommentAction->execute($eventRequest, $request->user(), $request->validated()['comment']);

        return redirect()->back();
    }
}
