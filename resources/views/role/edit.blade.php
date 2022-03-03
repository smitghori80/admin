<!-- Main content -->
@extends('components.layout')
@section('title','Role edit')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Role</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Role</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form class="form-horizontal" action={{ route('role.update', ['id' => $roles->id]) }} method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">Role edit</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('role.list') }}" class="btn btn-danger float-right " style="float: right"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for=""> Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $roles->name) }}"
                            placeholder="Enter Role Name" id="name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <label for=""> Permission</label>
                        @foreach ($permissions as $permission)
                            <div class="col-lg-3 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="checkbox" id='permission' class="permission" data-toggle="toggle"
                                            name="permission[]" @if (in_array($permission->id, $permissions_id)) checked @endif value="{{ $permission->id }}">
                                        <label class="form-check-label"
                                            for="permission">{{ Str::replace('-', ' ', $permission->name) }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permission')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Edit Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

