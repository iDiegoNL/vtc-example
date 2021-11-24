<?php /** @var App\Models\Company $company */ ?>

@extends('layouts.app')

@push('scripts-top')
    @isset($company->cover_image_path)
        <style>
            .breadcrumbs-v1 {
                height: 350px;
                background: url({{ asset($company->cover_image_path) }}) center no-repeat !important;
                background-size: cover !important;
            }
        </style>
    @endisset
@endpush

@section('title', "Virtual Trucking Company - $company->name")

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="VTC" href="{{ route('vtc.index') }}"/>
    <x-breadcrumb :name="$company->name" active/>
@endsection

@section('content')
    <div class="breadcrumbs-v1 text-center hidden-sm hidden-xs">
        <div class="container" style="position: relative; top: 150px; left: -10px; z-index: 1">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <a href="{{ route('vtc.show', $company->id) }}">
                        <img src="{{ asset($company->logo_path) }}" alt="{{ $company->name }}'s logo"
                             class="{{ $company->logo_border ? 'rounded-circle' : 'rounded-circle-no-border' }} animated fadeInLeft dropshadow">
                    </a>
                </div>
                <div class="col-lg-10 col-md-9">
                    <div class="text-left animated fadeInLeft dropshadow">
                        <h2 style="font-size: 30px; display: inline-block; margin: 3px 0; padding: .7rem; background: rgba(0, 0, 0, 0.7)"
                            class="break-all">
                            {{ $company->name }}
                        </h2>
                        <br>
                        <h4 style="font-size: 16px; display: inline-block; margin-top: 2px; padding: .7rem; background: rgba(0, 0, 0, 0.7)">
                            {{ $company->slogan }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 60px"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">

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
                    @if(Auth::user()->company_id && Auth::user()->company_id !== $company->id)
                        <x-alert type="danger">
                            You are already in a VTC.
                        </x-alert>
                    @endif

                    @if(!$company->recruitment_open)
                        <x-alert type="danger">
                            This VTC is not recruiting right now.
                        </x-alert>
                    @endif

                    @can('apply', $company)
                        <a href="#" class="btn btn-success w-100 margin-bottom-10" data-toggle="modal"
                           data-target="#form-apply">Apply Now!</a>
                    @endcan

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
@endsection
