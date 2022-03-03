@extends('components.layout')
@section('title','User edit')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">User</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="row">

                    <div class="col-md">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="card-title">Update user Profile</h3>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('user.list') }}" class="btn btn-danger float-right "
                                            style="float: right"><i class="fas fa-backward"></i>
                                            Back</a>
                                    </div>
                                </div>
                            </div>

                            <form method="post" id="user_form" action={{ route('user.update') }}
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for=""> Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $user->name) }}" placeholder="Enter Last Name" id="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Address</label>
                                        <input type="email" class="form-control" value="{{ old('email', $user->email) }}"
                                            name="email" placeholder="Enter Email" id="email">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Password" id="password">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirmation Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Enter confirmation Password" id="password_confirmation">
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <?php $hobbies = explode(',', $user->hobbies); ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="">Hobby's </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Read_Book
                                                                                                        " name="hobbies[]"
                                                        @if (in_array('Read_Book', $hobbies)) checked @endif value="Read_Book">
                                                    <label class="form-check-label" for="Read_Book">Read_Book</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Singing"
                                                        name="hobbies[]" @if (in_array('Singing', $hobbies)) checked @endif value="Singing">
                                                    <label class="form-check-label" for="Singing">Singing</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Cooding"
                                                        name="hobbies[]" @if (in_array('Cooding', $hobbies)) checked @endif value="Cooding">
                                                    <label class="form-check-label" for="Singing">Cooding</label>

                                                    @error('hobbies')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <!-- radio -->
                                            <div class="form-group">
                                                <div class="form-check" id="gender">
                                                    <label>Gender</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="males" type="radio" name="gender"
                                                        value="male" @if (old('gender', $user->gender) == 'male') checked @endif>
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="females" type="radio" name="gender"
                                                        value="female" @if (old('gender', $user->gender) == 'female') checked @endif>
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control custom-select" name="countrie_id"
                                                    id="countrie_id">
                                                    <option value="">Select </option>
                                                    @foreach ($countries as $countrys)
                                                        <option value={{ $countrys->id }} @if (old('country', $user->countrie_id) == $countrys->id) selected @endif
                                                            name={{ $countrys->id }}>
                                                            {{ $countrys->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('countrie_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <input type="hidden" id="state" value="{{ $user->state_id }}">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control custom-select" name="state_id" id="state_id">
                                                    <option value=""> Select State</option>
                                                </select>
                                                @error('state_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ old('city', $user->city) }}" placeholder="Enter City" id="city">
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label> Role</label>
                                            <select id='role' class="role form-control" name="role[]" multiple>
                                                @foreach ($user->roles as $role)
                                                    <option value="{{ $role->id }}" selected>{{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="image" id="image">
                                            </div>
                                        </div>
                                        <img src={{ $user->image ? asset('storage/user/' . $user->image) : asset('/assets/images/users/1.jpg') }} id="img" class="brand-image img-circle elevation-3" style="height: 100px; width: 100px" alt="no image">
                                        <div id="message">
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <input type="submit" name="edit" id="edit" class="btn btn-primary" value="Edit User">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')

        <script>
            $("#success").hide();
            $("#message").hide();

            var id = $("#countrie_id").val();
            state(id);

            function state(id) {
                $.ajax({
                    type: "get",
                    url: "{{ route('user.state') }}",
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'JSON',

                    success: function(response) {
                        var state_id = $("#state").val();
                        $('#state_id').empty();
                        for (let state of response.state) {
                            if (state_id == state.id) {
                                $('#state_id').append('<option value=' + state.id +
                                    ' selected>' + state.name + '</option>');
                            } else {

                                $('#state_id').append('<option value="' + state.id +
                                    '">' + state.name + '</option>');
                            }
                        }
                    }
                });
            }
            $("#countrie_id").change(function(e) {
                e.preventDefault();
                $('#state_id').empty();
                var id = $("#countrie_id").val();
                if (id != '') {
                    state(id);
                }
            });

            search_data = function(params) {
                return {
                    searchTerm: params.term,

                };
            }

            $(".role").select2({
                // maximumSelectionLength: 2
                multiple: true,
                ajax: {
                    url: "{{ route('user.role') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: search_data,
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                    success: function(response) {
                        product_data = response;
                    }
                }
            });

        </script>



    @endsection
