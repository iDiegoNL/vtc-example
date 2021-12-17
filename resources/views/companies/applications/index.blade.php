<?php /** @var App\Models\Company $company */ ?>
<?php /** @var App\Models\CompanyApplication $applications */ ?>

@extends('layouts.app')

@section('title', 'Virtual Trucking Company - Applications')

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="VTC" href="{{ route('vtc.index') }}"/>
    <x-breadcrumb :name="$company->name" href="{{ route('vtc.show', $company->id) }}"/>
    <x-breadcrumb name="Applications" active/>
@endsection

@section('content')
    <x-company-header :company="$company"/>

    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Last Updated</th>
                <th>Closed</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>
                        <a href="#" style="color: {{ $application->applicant->roles->first()->color }}" target="_blank"
                           rel="noreferrer nofollow noopener">{{ $application->applicant->name }}</a>
                    </td>
                    <td>
                    <span class="badge" style="background-color: #32cd32">
                        {{ ucwords($application->status) }}
                    </span>
                    </td>
                    <td>{{ $application->created_at }}</td>
                    <td>{{ $application->updated_at }}</td>
                    <td>
                        @isset($application->closed_at)
                            {{ $application->closed_at }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vtc.applications.show', [$company->id, $application->id]) }}">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <x-alert>
                    <b>There are no applications for your VTC yet.</b>
                </x-alert>
            @endforelse
            </tbody>
        </table>
        <div class="text-center">
            {{ $applications->links() }}
        </div>
    </div>
@endsection
