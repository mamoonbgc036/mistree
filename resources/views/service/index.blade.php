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
                                <th>Is_Approved</th>
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
            { data: 'is_approved', name: 'is_approved' },
            { data: 'status', name: 'status' },
            { data: 'start_date', name: 'start_date' },
            { data: 'action', name: 'action' },
        ]
    });

    $(document).on('click', '.service-delete', function (e) {
        e.preventDefault();
        let $btn = $(this);
        let id = $(this).data('id');
        let url = "{{ route('service.delete', ':id') }}";
        let service_del_url = url.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'You would not be able revert back',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: service_del_url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $btn.closest('tr').remove();
                        Swal.fire({
                            title: 'Deleted',
                            text: 'Your Service has been deleted',
                            icon: 'success',
                        })
                    }
                })
            }
        })
    });
</script>

@endsection