@extends('layouts.auth_layout')
@section('auth')
<div class="col-md-8 ps-md-0">
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo logo-light d-block mb-2">মিস্ত্রী</a>
        <h5 class="text-warning fw-normal mb-4">Admin Login</h5>
        @if(Session::has('login_error'))
        <p class="text-danger">{{ Session::get('login_error') }}</p>
        @endif
        <form class="forms-sample" action="{{route('login')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="userEmail" class="form-label text-info">Phone
                    Number</label>
                <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" />
                @error('phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label text-info">Password</label>
                <input type="password" class="form-control" id="userPassword" autocomplete="current-password"
                    placeholder="Password" name="password" />
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="authCheck" />
                <label class="form-check-label" for="authCheck">
                    Remember me
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">
                    Login
                </button>
            </div>
        </form>
        <a href="{{ route('register') }}" class="d-block mt-3 text-warning">Not A User ! Register</a>
    </div>
</div>
@endsection