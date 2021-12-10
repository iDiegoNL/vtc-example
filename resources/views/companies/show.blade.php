<?php /** @var App\Models\Company $company */ ?>

@extends('layouts.app')

@section('title', "Virtual Trucking Company - $company->name")

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="VTC" href="{{ route('vtc.index') }}"/>
    <x-breadcrumb :name="$company->name" active/>
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
        <div class="row">
            <div class="col-md-3">

                <div>
                    @can('update', $company)
                        <h2 class="heading-sm"><i class="fas fa-cogs"></i> VTC Settings</h2>
                    @endif
                    <ul class="list-group sidebar-nav-v1">
                        @can('update', $company)
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fas fa-fw fa-edit fa-fw"></i> Edit VTC
                                </a>
                            </li>
                        @endcan
                        @can('update', $company)
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Events
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="far fa-fw fa-newspaper fa-fw"></i> News Post
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span
                                    class="badge {{ $company->applications()->openApplications()->exists() ? 'badge-orange' : 'badge-green' }} rounded-2x pull-right pb-1">
                                    {{ $company->applications()->openApplications()->count() }}
                                </span>
                                <a href="{{ route('vtc.applications.index', $company->id) }}">
                                    <i class="fas fa-fw fa-users fa-fw"></i> All Applications
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="far fa-fw fa-clipboard-list fa-fw"></i> Blacklist
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="fal fa-images fa-fw"></i> Gallery
                                </a>
                            </li>
                        @endcan
                        @if(Auth::check() && Auth::user()->cannot('viewAny', [App\Models\CompanyApplication::class, $company]))
                            <li class="list-group-item">
                                <a href="{{ route('vtc.applications.index', $company->id) }}">
                                    <i class="fas fa-fw fa-users fa-fw"></i> View my applications
                                </a>
                            </li>
                        @endif
                    </ul>
                    <hr>
                </div>

                <div class="profile-body">
                    <div class="panel panel-profile p-1">
                        <div class="panel-heading overflow-h">
                            <h2 class="heading-sm pull-left"><i class="far fa-question-circle"></i>
                                Information
                            </h2>
                        </div>
                        <div class="panel-body" style="margin: 5px">
                            <div class="break-all autolink img-max-100">
                                <x-markdown>
                                    {{ $company->information }}
                                </x-markdown>
                            </div>

                            <hr class="margin-top-20">

                            <h5>
                                <i class="fas fa-tag"></i> Tag: {{ $company->tag }}.
                            </h5>


                            <h5>
                                <i class="fas fa-globe-americas"></i>
                                Created: {{ $company->created_at->format('d M Y H:i') }}
                            </h5>

                            <div class="margin-bottom-10"></div>
                            <h5>
                                <i class="fas fa-building"></i> Owner:
                                <a href="#">{{ $company->owner->name }}</a>
                            </h5>

                            <h5>
                                <i class="fas fa-user-friends"></i>
                                Members: {{ $company->members->count() }}
                            </h5>

                            <h5>
                                <i class="fas fa-address-card"></i>
                                Recruitment:
                                @if($company->recruitment_open)
                                    <span class="text-success">Open</span>
                                @else
                                    <span class="text-danger">Closed</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-body mt-3">
                    <div class="panel panel-profile px-3 pb-3">
                        <div class="panel-heading overflow-h">
                            <h2 class="heading-sm pull-left">
                                <i class="fas fa-gavel"></i> Rules
                            </h2>
                        </div>
                        <div class="panel-body p-3 break-all autolink img-max-100">
                            <x-markdown>
                                {{ $company->rules }}
                            </x-markdown>
                        </div>
                    </div>
                </div>
                <div class="mt-3"></div>
            </div>

            <div class="col-md-3">
                @auth
                    @if(!$company->isMember(Auth::user()))
                        @can('create', [App\Models\CompanyApplication::class, $company])
                            <a href="#" class="btn btn-success w-100 margin-bottom-10" data-toggle="modal"
                               data-target="#form-apply">Apply Now!</a>
                        @else
                            <x-alert type="danger">
                                {{ Gate::inspect('create', [App\Models\CompanyApplication::class, $company])->message() }}
                            </x-alert>
                        @endcan
                    @endif

                    @can('leave', $company)
                        <a href="#" class="btn btn-danger w-100 margin-bottom-10" data-toggle="modal"
                           data-target="#form-leave">
                            <i class="fas fa-door-open"></i> Leave my VTC
                        </a>
                    @endcan
                @endauth

                <div class="profile-body">
                    <div class="profile-body">
                        <div class="panel panel-profile p-1">
                            <div class="panel-heading overflow-h">
                                <h2 class="heading-sm pull-left">
                                    <i class="fa fa-list"></i> Requirements
                                </h2>
                            </div>
                            <div class="panel-body break-all img-max-100" style="margin: 5px; padding-bottom: 8px;">
                                <x-markdown>
                                    {{ $company->requirements }}
                                </x-markdown>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-body">
                    <div class="profile-body">
                        <div class="panel panel-profile p-1">
                            <div class="panel-heading overflow-h">
                                <h2 class="heading-sm pull-left">
                                    <i class="fas fa-users"></i> Members
                                </h2>
                            </div>
                            <div class="panel-body" style="margin: 5px">
                                @foreach($company->members->take(6) as $member)
                                    <div style="padding-bottom: 5px">
                                        <div class="news-v2-desc bg-color-light">
                                            <div class="mx-0 d-flex">
                                                <div class="margin-right-5">
                                                    <img style="min-width: 50px; width: 50px; height: 50px"
                                                         src="https://static.truckersmp.network/avatarsN/defaultavatar.png"
                                                         alt="{{ $member->name }}">
                                                </div>
                                                <div class="w-100">
                                                    @if($company->owner_id === $member->id)
                                                        <i class="fas fa-star text-warning" data-toggle="tooltip"
                                                           data-original-title="Owner"></i>
                                                    @endif
                                                    <a href="#">{{ $member->name }}</a>
                                                    @if($company->owner_id === $member->id)
                                                        <div>
                                                            <span style="color: #72c02c">Owner</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <a href="#" class="btn btn-success w-100">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('leave', $company)
        <div class="modal fade" id="form-leave" tabindex="-1" role="dialog" aria-labelledby="Leave" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Are you sure you want to leave {{ $company->name }}?</h3>
                    </div>
                    <form action="{{ route('vtc.leave', $company->id) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <p>
                                If you choose to <strong>leave</strong>, you will need to submit another application to
                                <strong>re-join</strong> the virtual trucking company.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default ml-3" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Leave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('create', [App\Models\CompanyApplication::class, $company])
        <div class="modal fade" id="form-apply" tabindex="-1" role="dialog"
             aria-labelledby="Apply" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Are you sure you want to apply at {{ $company->name }}?</h3>
                    </div>

                    <form action="{{ route('vtc.applications.store', $company) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="description">Talk a bit about yourself:</label>
                                <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" value="apply">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
