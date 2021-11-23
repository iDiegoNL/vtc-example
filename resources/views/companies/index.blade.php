@extends('layouts.app')

@push('scripts-top')
    <link href="{{ asset('assets/css/plugins/blocks.css') }}" rel="stylesheet">
@endpush

@section('title', 'Virtual Trucking Company')

@section('content')
    <div class="container content-sm">
        <div class="row d-flex-fw-wrap">
            @foreach($companies as $company)
                <div class="col-lg-3 pb-5 col-sm-12 w-100">
                    <div class="profile-body p-3 h-100 d-flex flex-column">
                        <div class="panel panel-profile">
                            <img src="{{ asset($company->logo_path) }}"
                                 class="vtc-logo-img" alt="{{ $company->name }}'s logo">
                            <div class="text-center">
                                <h3>
                                    <a href="{{ route('vtc.show', $company->id) }}" class="break-all">
                                        {{ $company->name }}
                                    </a>
                                </h3>
                                <p class="break-all">{{ $company->slogan }}</p>
                            </div>
                            <div>
                                <p>Members: {{ $company->members()->count() }}</p>
                                <p>Created on {{ $company->created_at->format('d M H:i') }}</p>
                                <p>
                                    Recruitment:
                                    @if($company->recruitment_open)
                                        <span class="label label-success">Open</span>
                                    @else
                                        <span class="label label-danger">Closed</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-center mt-auto">
                            <a href="{{ route('vtc.show', $company->id) }}" target="_blank"
                               class="btn btn-success btn-block">View VTC</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
