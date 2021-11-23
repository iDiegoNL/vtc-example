@extends('layouts.app')

@push('scripts-top')
    <link href="{{ asset('assets/css/pages/page_log_reg_v1.css') }}" rel="stylesheet">
@endpush

@section('title', 'Log in to your account')

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="Login" active/>
@endsection

@section('content')
    <div class="container content">
        @if($errors->any())
            <x-alert title="Fix the errors below and try again" type="danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="autolink">{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <form class="reg-page" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="reg-header">
                        <h2>Log in to your account</h2>
                    </div>
                    <p class="text-center">
                        <em>Please note that these are not your Steam Community credentials.</em>
                    </p>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fas fa-mail-bulk"></i></span>
                        <x-forms.input name="email" type="email" placeholder="E-mail"/>
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                        <x-forms.input name="password" type="password" placeholder="Password"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6 checkbox">
                            <label><input type="checkbox" name="remember">Remember Me</label>
                        </div>
                        <div class="col-md-6">
                            <button class="btn-u pull-right" type="submit">Login</button>
                        </div>
                    </div>
                    <hr>
                    <h4>Forgot your password?</h4>
                    <p>No worries, <a href="{{ route('password.request') }}">click here</a> to reset your
                        password.
                    </p>
                    <hr>
                    <h4>Are you new here?</h4>
                    <p>Don't have an account? <a href="{{ route('register') }}">Click here</a> to create an
                        account!</p>
                </form>
            </div>
        </div>
    </div>
@endsection
