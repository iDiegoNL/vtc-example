<?php

namespace App\Http\Controllers;

use App\Actions\EventRequest\CreateEventRequestAction;
use App\Http\Requests\StoreEventRequestRequest;
use App\Models\EventRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventRequestResourceController extends Controller
{
    private CreateEventRequestAction $createEventRequestAction;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(
        CreateEventRequestAction $createEventRequestAction
    )
    {
        $this->middleware('auth');

        $this->createEventRequestAction = $createEventRequestAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $personalRequests = EventRequest::personal()->get();

        return view('event-requests.index', ['personalRequests' => $personalRequests]);
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
        $this->authorize('view', $eventRequest);

        return view('event-requests.show');
    }
}
