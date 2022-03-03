@extends('components.layout')
@section('title', 'User list')
@section('content')



    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title m-3 p-2">User List </h4>
                    </div>
                    <div class="col-md-2">
                        @can('user-create')
                            <a href="{{ route('user.create') }}" class="btn btn-success m-3 float-right p-2 "><i
                                    class="fas fa-plus"></i>
                                Add user</a>
                        @endcan
                    </div>
                </div>

                <table class="table table-bordered data-table  table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Roles</th>
                            <th>created_at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </body>
@endsection

@section('script')
    <script type="text/javascript">
        function deleteUser(id) {
            console.log(id);
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
                        url: "{{ route('user.destroy') }}",
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(data) {
                            $("#success").show();
                            $('#success ').html(data.message);
                            table.ajax.reload();
                            toastr.success("Data Delete successfully!")
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        },
                        error: function(data) {
                            table.ajax.reload();
                            toastr.error("unexpected error!")

                        }
                    });
                }
            })
        }

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.list') }}",
            columns: [{
                    data: 'image',
                    name: 'id',

                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'hobbies',
                    name: 'hobbies'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'roles',
                    name: 'roles',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'edit',
                    name: 'edit',
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


