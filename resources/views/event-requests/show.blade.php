<?php /** @var App\Models\EventRequest $eventRequest */ ?>

@extends('layouts.app')

@section('title', "Event Request - $eventRequest->name")

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="Event Request" href="{{ route('event-request.index') }}"/>
    <x-breadcrumb :name="$eventRequest->name" active/>
@endsection

@section('content')
    <div class="container content-sm">
        @if ($errors->any())
            <x-alert type="danger">
                Fix the errors below and try again
                <br>
                <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="autolink">{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <table class="table">
            <tbody>
            <tr>
                <td>Requested by</td>
                <td>
                    <a href="#" style="color: {{ $eventRequest->requester->roles->first()->color }}" target="_blank"
                       rel="noreferrer nofollow noopener">{{ $eventRequest->requester->name }}</a>
                </td>
            </tr>
            <tr>
                <td>Claimed by</td>
                <td>
                    @if($eventRequest->staff()->exists())
                        <a href="#" style="color: {{ $eventRequest->staff->roles->first()->color }}"
                           rel="noreferrer nofollow noopener">{{ $eventRequest->staff->name }}</a>
                    @else
                        N/A
                    @endif
                    @if($eventRequest->staff_id !== Auth::user()->id && Auth::user()->can('claim', $eventRequest))
                        <a href="#" class="btn btn-warning pull-right" data-toggle="modal"
                           data-target="#claim-request">Claim</a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span class="badge" style="background-color: #32cd32">
                        {{ ucwords($eventRequest->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Event name</td>
                <td>{{ $eventRequest->name }}</td>
            </tr>
            <tr>
                <td>Start at</td>
                <td>{{ $eventRequest->start_at }}</td>
            </tr>
            <tr>
                <td>End at</td>
                <td>{{ $eventRequest->end_at }}</td>
            </tr>
            <tr>
                <td>Event link</td>
                <td><a href="{{ $eventRequest->event_link }}" target="_blank">{{ $eventRequest->event_link }}</a></td>
            </tr>

            <tr>
                <td>Requested at</td>
                <td>{{ $eventRequest->created_at }}</td>
            </tr>
            <tr>
                <td>Last reply</td>
                <td>{{ $eventRequest->latestComment->created_at ?? 'N/A' }}</td>
            </tr>
            @can('update', $eventRequest)
                <tr>
                    <td colspan="2">
                        <a href="#" data-toggle="modal" data-target="#decline-request" class="btn btn-danger w-100">
                            Decline
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="#" data-toggle="modal" data-target="#accept-request" class="btn btn-success w-100">
                            Accept
                        </a>
                    </td>
                </tr>
            @endcan
            </tbody>
        </table>

        <hr>

        <div>
            <h3>Event Description</h3>
            <div class="comment">
                <p class="autolink">
                    <x-markdown>
                        {{ $eventRequest->comment }}
                    </x-markdown>
                </p>
            </div>
        </div>

        <div>
            <h3>Event Rules</h3>
            <div class="comment">
                <p class="autolink">
                    <x-markdown>
                        {{ $eventRequest->rules }}
                    </x-markdown>
                </p>
            </div>
        </div>

        @can('viewComments', $eventRequest)
            <hr>
            <h3>Comments</h3>
            <div class="comment">
                <h3>
                    <span class="badge"
                          style="background-color: {{ $eventRequest->requester->roles->first()->color }}; font-weight: bold;">
                        {{ ucwords($eventRequest->requester->roles->first()->name) }}
                    </span>
                    <a href="#" style="color: {{ $eventRequest->requester->roles->first()->color }}"
                       class="">{{ $eventRequest->requester->name }}</a>
                    at {{ $eventRequest->created_at }}
                </h3>
                <p class="autolink">
                    <x-safe-text :text="$eventRequest->comment"/>
                </p>
            </div>

            @foreach($eventRequest->comments as $comment)
                <x-comment :comment="$comment"/>
            @endforeach

            @can('comment', $eventRequest)
                <hr>
                <form action="{{ route('event-request.comment', $eventRequest) }}" method="post">
                    @csrf
                    <label for="comment">Comment</label>
                    <textarea id="comment" class="form-control" rows="15" name="comment"></textarea>
                    <button type="submit" name="action" value="comment" class="btn btn-success my-3">
                        Submit comment
                    </button>
                </form>
            @endcan
        @endcan
    </div>

    @can('claim', $eventRequest)
        <div class="modal fade" id="claim-request" tabindex="-1" role="dialog" aria-labelledby="Claim event request"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('event-request.claim', $eventRequest) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Claim Event Request</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to claim this event request?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Claim</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    @can('update', $eventRequest)
        <div class="modal fade" id="decline-request" tabindex="-1" role="dialog" aria-labelledby="Decline event request"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('event-request.update', $eventRequest) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="declined">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Decline Event Request</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to decline this event request?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Decline</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="accept-request" tabindex="-1" role="dialog" aria-labelledby="Accept event request"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('event-request.update', $eventRequest) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="accepted">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Accept Event Request</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to accept this event request?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Decline</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
