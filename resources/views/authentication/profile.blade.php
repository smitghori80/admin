@extends('components.layout')
@section('title','Profile')

@section('content')
    <section class="content">
        <strong>
            <div id="success" class="fixed-bottom bg-danger text-white py-2 px-5 rounded  text-sm" style="margin-left:85%;"
                x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"></div>
        </strong>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update user Profile</h3>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger float-right p-2"><i
                                    class="fas fa-backward"></i>
                                Back</a>
                        </div>

                        <form method="post" id="user_form" action={{ route('profileFormSubmit') }}
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src={{ $user->image ? asset('storage/user/' . $user->image) : asset('/assets/images/users/1.jpg') }}
                                            id="img" style="height: 20%; width: 100%" alt="no image">
                                    </div>
                                    <div class="col-sm-10">

                                        <div class="form-group">

                                            <label for=""> Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $user->name) }}" placeholder="Enter Last Name"
                                                id="name">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Address</label>
                                            <input type="email" class="form-control"
                                                value="{{ old('email', $user->email) }}" name="email"
                                                placeholder="Enter Email" id="email">
                                            @error('email')
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
                                                        <input class="form-check-input p-2" type="checkbox" id="Read_Book
                                                                                                " name="hobbies[]" @if (in_array('Read_Book', $hobbies)) checked @endif value="Read_Book">
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
                                                        <input class="form-check-input" id="males" type="radio"
                                                            name="gender" value="male" @if (old('gender', $user->gender) == 'male') checked @endif>
                                                        <label class="form-check-label" for="male">Male</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="females" type="radio"
                                                            name="gender" value="female" @if (old('gender', $user->gender) == 'female') checked @endif>
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
                                                    <select class="form-control custom-select" name="countrieId"
                                                        id="countrieId">
                                                        <option value="">Select </option>
                                                        @foreach ($countries as $countrys)
                                                            <option value={{ $countrys->id }} name={{ $countrys->id }}
                                                                @if (old('country', $user->countrie_id) == $countrys->id) selected @endif>
                                                                {{ $countrys->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('countrieId')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <input type="hidden" id="state" value="{{ $user->state_id }}">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control custom-select" name="stateId" id="stateId">
                                                        <option value=""> Select State</option>
                                                    </select>
                                                    @error('stateId')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ old('city', $user->city) }}" placeholder="Enter City"
                                                    id="city">
                                                @error('city')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="image" id="image">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="images" id="images"
                                                    value="{{ $user->image }}">
                                            </div>


                                            <div id="message">
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <input type="submit" name="edit" id="edit" class="btn btn-primary"
                                                value="Change Data">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('script')

        <script>
            $("#success").hide();;
            $("#message").hide();

            var id = $("#countrieId").val();
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
                        var stateId = $("#state").val();
                        $('#stateId').empty();
                        for (let state of response.state) {
                            if (stateId == state.id) {
                                $('#stateId').append('<option value=' + state.id +
                                    ' selected>' + state.name + '</option>');
                            } else {

                                $('#stateId').append('<option value="' + state.id +
                                    '">' + state.name + '</option>');
                            }
                        }
                    }
                });
            }
            $("#countrieId").change(function(e) {
                e.preventDefault();
                $('#stateId').empty();
                var id = $("#countrieId").val();
                if (id != '') {
                    state(id);
                }
            });

            {{-- Edit data table velitation --}}


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
