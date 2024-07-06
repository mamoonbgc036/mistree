@extends('layouts.base_layout')
@section('content')
<div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper">
                                <img src="{{ asset('assets/images/auth/login.png') }}" alt="login" />
                            </div>
                        </div>
                        @yield('auth')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection