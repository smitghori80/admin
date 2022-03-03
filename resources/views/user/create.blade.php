<!-- Main content -->
@extends('components.layout')
@section('title','User create')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">User</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form class="form-horizontal" action={{ route('user.store') }} method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">Add User </h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('user.list') }}" class="btn btn-danger float-right " style="float: right"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for=""> Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Enter User Name" id="name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                            placeholder="Enter Email" id="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password"
                            id="password">
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-check" id="hobbies[]">
                                    <label>Hobby's </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input " id="Singing" type="checkbox" name="hobbies[]"
                                        value="Singing">
                                    <label class="form-check-label" for="Singing">Singing</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="Cooding" type="checkbox" name="hobbies[]"
                                        value="Cooding">
                                    <label class="form-check-label" for="Cooding">Cooding</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="Read_Book" type="checkbox" name="hobbies[]"
                                        value="Read_Book">
                                    <label class="form-check-label" for="Read_Book">Read Book</label>
                                </div>
                                @error('hobbies')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <span id="spnError" class="error" style="display: none">Please select at-least one
                                Fruit.</span>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-check" id="gender">
                                    <label>Gender</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="male" type="radio" name="gender" value="male"
                                        {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="female" type="radio" name="gender" value="female"
                                        {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control custom-select" name="countrie" id="countrie">
                                    <option value="">Select Country </option>
                                    @foreach ($countries as $countrie)
                                        <option value={{ $countrie->id }}
                                            {{ old('countrie') == $countrie->id ? 'selected' : '' }}>
                                            {{ $countrie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('countrie')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control custom-select" name="state" id="stateId">
                                    <option value=""> Select State</option>
                                </select>
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}"
                                placeholder="Enter City" id="city">
                            @error('city')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Role</label>
                            <select id='role' class="role form-control" name="role[]" multiple>
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

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script>
        $("#countrie").change(function(e) {
            e.preventDefault();
            $('#stateId').empty();

            var id = $("#countrie").val();
            if (id != '') {
                state(id);
            }
        });

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
                    $('#stateId').empty();
                    $('#stateId').append('<option value=""> Select State</option>');
                    for (let state of response.state) {
                        $('#stateId').append('<option value="' + state.id +
                            '"@if (old('state') == '+state.id+') selected @endif>' + state.name + '</option>');
                    }
                }
            });
        }


        search_data = function(params) {
            return {
                searchTerm: params.term,

            };
        }
        $(".role").select2({
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
