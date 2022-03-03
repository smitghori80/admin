@extends('components.layout')
@section('title', 'Role list')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title m-3 p-2">Role List </h4>
                    </div>
                    <div class="col-md-2">
                        @can('role-create')
                            <a href="{{ route('role.create') }}" class="btn btn-success m-3 float-right p-2 "><i
                                    class="fas fa-plus"></i>
                                Add role</a>
                        @endcan
                    </div>
                </div>
                <table class="table table-bordered data-table  table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function deleteRole(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('role.destroy') }}",
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(data) {

                            table.ajax.reload();
                            toastr.error("Data Delete successfully!")
                        },
                        error: function() {
                            table.ajax.reload();
                            toastr.error("unexpected error!")


                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.list') }}",
            columns: [{
                    "data": "name"
                },
                {
                    data: 'action',
                    name: 'action',

                    orderable: false,
                    searchable: false
                },
                {
                    data: 'delete',
                    name: 'delete',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    </script>
@endsection
