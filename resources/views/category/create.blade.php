@extends('layouts.dashboard_layout')
@section('dashboard')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Category Create</h6>
                <form enctype="multipart/form-data" action="{{ route('category') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Bangla Name</label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">English Name</label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="bn_name">
                                @error('bn_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Select Image</label>
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary mt-2">Create Category</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection