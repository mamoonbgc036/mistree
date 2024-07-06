@extends('layouts.auth_layout')
@section('auth')
<div class="col-md-8 ps-md-0">
    <div class="auth-form-wrapper px-4 py-5">
        <a href="#" class="noble-ui-logo logo-light d-block mb-2">Interactive</a>
        <h5 class="text-warning fw-normal mb-4">Create admin account.</h5>
        <form class="forms-sample" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label text-info">Name</label>
                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="Username"
                    placeholder="Your name" name="name" />
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label text-info">Phone Number</label>
                <input type="text" class="form-control" id="userEmail" placeholder="Phone number" name="phone" />
                @error('phone')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3" data-select2-id="7">
                <label class="form-label">Select Type</label>
                <select class="js-example-basic-single form-select select2-hidden-accessible" data-width="100%"
                    data-select2-id="1" tabindex="-1" aria-hidden="true" name="type">
                    <option value="">Select Your Type</option>
                    <option value="Single" data-select2-id="3">Single Worker</option>
                    <option value="Company" data-select2-id="17">Company</option>
                    <option value="Employer" data-select2-id="17">Employer</option>
                </select>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label text-info" for="formFile">Image Upload</label>
                <input class="form-control" name="image" type="file" id="formFile" />
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label text-info">Password</label>
                <input type="password" class="form-control" id="userPassword" autocomplete="current-password"
                    placeholder="Password" name="password" />
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="authCheck" />
                <label class="form-check-label" for="authCheck">
                    Remember me
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    Sign up
                </button>
            </div>
        </form>
        <a href="{{ route('login') }}" class="d-block mt-3 text-info">Already Register ? Login</a>
    </div>
</div>
@endsection