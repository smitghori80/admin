<!-- Main content -->
@extends('components.layout')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Role</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Role</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form class="form-horizontal" action={{ route('role.permissionsSubmit', ['id' => $roles->id]) }} method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">Role Permissions</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('role.list') }}" class="btn btn-danger float-right " style="float: right"><i
                                class="fas fa-backward"></i>
                            Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <h4 class="card-title"> {{ $roles->name }}</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="">Permissions</label>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" id='permission' class="permission" data-toggle="toggle"
                                        name="permission[]" @if (in_array($permission->id, $permissions_id)) checked @endif value="{{ $permission->id }}">
                                    <label class="form-check-label" for="Read_Book">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top">
                <div class="card-body">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection

