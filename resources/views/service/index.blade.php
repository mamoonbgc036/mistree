@extends('layouts.dashboard_layout')
@section('dashboard')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">All Services</h4>
                    <a href="{{ route('service.create') }}" class="btn btn-warning btn-sm text-white">Add Services</a>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-dark" id="service_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Charge</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Free Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#service_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('service') }}",
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'charge', name: 'charge' },
            { data: 'mobile', name: 'mobile' },
            { data: 'address', name: 'address' },
            { data: 'status', name: 'status' },
            { data: 'start_date', name: 'start_date' },
            { data: 'action', name: 'action' },
        ]
    });
</script>
@endsection