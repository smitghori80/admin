<!-- Main content -->
@extends('components.layout')
@section('title','Store data type')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Settings</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Store Data Type</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form class="form-horizontal" action={{ route('settings.storeDataType') }} method="post">
            @csrf
            <div class="card-body">
                <h4 class="card-title"> </h4>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-check" id="storeDataType">
                                <label>Store Data Type</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="direct" type="radio" name="storeDataType" value="direct"  @if (old('storeDataType', $settings->contains("direct")) == 'direct') checked @endif>
                                <label class="form-check-label" for="direct">Direct</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="api" type="radio" name="storeDataType" value="api" @if (old('storeDataType', $settings->contains("api")) == 'api') checked @endif>
                                <label class="form-check-label" for="api">API</label>
                            </div>
                            @error('storeDataType')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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

