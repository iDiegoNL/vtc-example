@extends('layouts.app')

@section('title', 'Event Request')

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="Event Request" active/>
@endsection

@section('content')
    <div class="container content">
        <h2>My requests for event server</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Event name</th>
                    <th>Start at</th>
                    <th>End at</th>
                    <th>Game</th>
                    <th>Approved</th>
                    <th>Status</th>
                    <th>Last reply</th>
                    <th>Updated at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($personalRequests as $personalRequest)
                    <tr>
                        <td>{{ $personalRequest->name }}</td>
                        <td>{{ $personalRequest->start_at }}</td>
                        <td>{{ $personalRequest->end_at }}</td>
                        <td>{{ $personalRequest->game }}</td>
                        <td>{{ $personalRequest->status === 'accepted' ? 'Yes' : 'No' }}</td>
                        <td>{{ ucwords($personalRequest->status) }}</td>
                        <td>TODO</td>
                        <td>{{ $personalRequest->updated_at }}</td>
                        <td>
                            <a href="{{ route('event-request.show', $personalRequest->id) }}">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">
                            You have not requested an event server.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
