<?php /** @var App\Models\Company $company */ ?>
<?php /** @var App\Models\CompanyApplication $application */ ?>

@extends('layouts.app')

@section('title', 'Virtual Trucking Company - Applications')

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="VTC" href="{{ route('vtc.index') }}"/>
    <x-breadcrumb :name="$company->name" href="{{ route('vtc.show', $company->id) }}"/>
    <x-breadcrumb name="Applications" href="{{ route('vtc.applications.index', $company->id) }}"/>
    <x-breadcrumb name="{{ $application->id }} - {{ $application->applicant->name }}" active/>
@endsection

@section('content')
    <x-company-header :company="$company"/>

    <div class="container">
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
                <td>Application by</td>
                <td>
                    <a href="#" style="color: {{ $application->applicant->roles->first()->color }}" target="_blank"
                       rel="noreferrer nofollow noopener">{{ $application->applicant->name }}</a>
                    @can('update', $application)
                        <a class="btn btn-success pull-right" data-toggle="modal" data-target="#player-info">
                            <i class="fas fa-info"></i>
                        </a>
                    @endcan
                </td>
            </tr>
            <tr>
                <td>Claimed by</td>
                <td>
                    @if($application->claimedBy()->exists())
                        <a href="#" style="color: {{ $application->claimedBy->roles->first()->color }}" target="_blank"
                           rel="noreferrer nofollow noopener">{{ $application->claimedBy->name }}</a>
                    @else
                        N/A
                    @endif
                    @can('assign', $application)
                        <a href="#" class="btn btn-danger pull-right" data-toggle="modal"
                           data-target="#reassign">Reassign</a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span class="badge" style="background-color: #32cd32">
                        {{ ucwords($application->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Requested at</td>
                <td>{{ $application->created_at }}</td>
            </tr>
            <tr>
                <td>Closed</td>
                <td>
                    @isset($application->closed_at)
                        {{ $application->closed_at }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @can('update', $application)
                <tr>
                    <td colspan="2">
                        <a href="#" data-toggle="modal" data-target="#in-progress-recruitment"
                           class="btn btn-warning w-100">
                            In-Progress
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="#" data-toggle="modal" data-target="#decline-recruitment" class="btn btn-danger w-100">
                            Decline
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="#" data-toggle="modal" data-target="#hire-recruitment" class="btn btn-success w-100">
                            Hire
                        </a>
                    </td>
                </tr>
            @elseif($application->company->isOwnedByUser() && Auth::id() !== $application->staff_id)
                <x-alert type="danger">
                    {{ Gate::inspect('update', $application)->message() }}
                </x-alert>
            @endcan
            </tbody>
        </table>
        <hr>
        <h3>Comments</h3>
        <div class="comment">
            <h3>
                <span class="badge" style="background-color: {{ $application->applicant->roles->first()->color }}; font-weight: bold;">
                    {{ ucwords($application->applicant->roles->first()->name) }}
                </span>
                <a href="#" style="color: {{ $application->applicant->roles->first()->color }}" class="">{{ $application->applicant->name }}</a>
                at {{ $application->created_at }}
            </h3>
            <p class="autolink">
                <x-safe-text :text="$application->description"/>
            </p>
        </div>

        @foreach($application->comments as $comment)
            <x-comment :comment="$comment"/>
        @endforeach

        @can('comment', $application)
            <hr>
            <form action="{{ route('vtc.applications.comment', [$company, $application]) }}" method="post">
                @csrf
                <label for="comment">Comment</label>
                <textarea id="comment" class="form-control" rows="15" name="comment"></textarea>
                <button type="submit" name="action" value="comment" class="btn btn-success my-3">
                    Submit comment
                </button>
            </form>
        @endcan
    </div>

    @can('assign', $application)
        <div class="modal fade" id="reassign" tabindex="-1" role="dialog" aria-labelledby="Reassign" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Change the recruiter for this application</h3>
                    </div>
                    <form action="{{ route('vtc.applications.assign', [$company, $application]) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="recruiter_id">Recruiter</label>
                                <select name="recruiter_id" id="recruiter_id" class="form-control" required>
                                    <option></option>
                                    {{-- Note: Since there is no permission system in this application, only the owner can be selected as the recruiter. --}}
                                    <option
                                        value="{{ $application->company->owner_id }}">{{ $application->company->owner->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" name="action" class="btn btn-success" value="reassign">
                                Reassign
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('update', $application)
        <div class="modal fade" id="player-info" tabindex="-1" role="dialog" aria-labelledby="Player Info"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">User Information</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped margin-bottom-0">
                            <tbody>
                            <tr>
                                <td>TruckersMP ID</td>
                                <td>
                                    <a href="#">
                                        {{ $application->applicant->id }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Member since</td>
                                <td>{{ $application->applicant->created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="in-progress-recruitment" tabindex="-1" role="dialog" aria-labelledby="In Progress Application"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('vtc.applications.update', [$company, $application]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="in progress">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Change application status to in progress</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure that you want to change this application status to in progress?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Change</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="decline-recruitment" tabindex="-1" role="dialog" aria-labelledby="Decline Application"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('vtc.applications.update', [$company, $application]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="declined">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Decline Applicant</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure that you want to deny this application?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Deny</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="hire-recruitment" tabindex="-1" role="dialog" aria-labelledby="Decline Application"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="{{ route('vtc.applications.update', [$company, $application]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="hired">
                    <div class="modal-header">
                        <h4 class="margin-bottom-0">Hire Applicant</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure that you want to hire this applicant?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Hire</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
