<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequestRequest;
use App\Models\EventRequest;
use Illuminate\Contracts\View\View;

class EventRequestResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('event-requests.index');
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
     * @param  \App\Http\Requests\StoreEventRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventRequest  $eventRequest
     * @return View
     */
    public function show(EventRequest $eventRequest): View
    {
        return view('event-requests.show');
    }
}
