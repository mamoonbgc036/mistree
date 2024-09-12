@extends('layouts.dashboard_layout')
@section('dashboard')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">Service Create</h6>
                <form enctype="multipart/form-data" action="{{ route('service.edit', $service->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">ServiceSS Name</label>
                                <input type="text" class="form-control" value="{{ $service->name }}"
                                    placeholder="Enter first name" name="name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" value="{{ $service->mobile }}"
                                    placeholder="Enter your mobile no" name="mobile">
                                @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" value="{{ $service->address }}" class="form-control"
                                    placeholder="Enter first name" name="address">
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Charge</label>
                                <input type="text" value="{{ $service->charge }}" class="form-control"
                                    placeholder="Enter your mobile no" name="charge">
                                @error('charge')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="" class="form-control" cols="30"
                                    rows="3">{{ old('description', $service->description) }}</textarea>
                                <!-- <textarea type="text" class="form-control" name="description"></textarea> -->
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div><!-- Row -->
                    <div class="row d-flex align-items-center my-2 justify-content-center">
                        <div class="col-md-3">
                            <label class="form-label">Service Category</label>
                            <select name="category_id" class="form-select form-select-sm mb-3">
                                <option value="" selected="">Open this select menu</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ $service->category_id == $categorie->id ?
                                    'selected' : '' }}>{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-3 align-items-center">
                            <div class=" d-flex flex-row">
                                <label for="">Status :</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input free" name="status" value="free"
                                        id="gender1" {{ $service->status == 'free' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gender1">
                                        Free
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input busy" name="status" value="busy"
                                        id="gender2" {{ $service->status == 'busy' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gender2">
                                        Busy
                                    </label>
                                </div>
                            </div>
                            @error('status')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 grid-margin stretch-card date_div" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">When Free</h6>
                                    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                                        <span class="input-group-text input-group-addon bg-transparent border-primary"
                                            data-toggle=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-calendar text-primary">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg></span>
                                        <input type="text"
                                            class="form-control bg-transparent border-primary flatpickr-input"
                                            placeholder="Select date" name="start_date" data-input="" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                    <div class="row d-flex align-items-center my-2 justify-content-center">
                        <div class="col-md-6">
                            <label for="example-multiselect">Select Service District:</label>
                            <select name="district_id" id="selected_district" class="mulplex form-control">
                                <option value="" selected>Choices District</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->districtid }}">{{ $district->districtnamebn }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Select Service Thana</label>
                            <select name="thana_id[]" id="example-multiselect" multiple class="form-control">
                                @foreach($service->thana as $than)
                                <option value="{{ $than->id }}" selected>{{ $than->thananamebn }}</option>
                                @endforeach
                            </select>
                            @error('thana_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="upload-container">
                        <input type="file" id="file-input" name="images[]" accept="image/*" multiple />
                        <label for="file-input" class="upload-label">
                            <span>Drag & Drop images here or click to select</span>
                        </label>
                        <div id="previews" class="preview-container"></div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create Category</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection