@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="ti-marker-alt bg-c-yellow"></i>
                <div class="d-inline">
                    <h4 class="mt-3">Edit Admin</h4>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="icofont icofont-simple-left "></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                </ul>
            </div>
        </div>

        {{-- Form Edit --}}
        <div class="mx-3 mb-3" style="margin-top:-25px !important" jus>
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <form method="post" action="{{ route('admins.update', $admin->user_id) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Admin Name</label>
                        <input type="text" class="form-control" id="name" value="{{$admin->name}}"
                            placeholder="{{$admin->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" value="{{$admin->email}}"
                            placeholder="{{$admin->email}}" name="email">
                    </div>
                    <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" name="image" class="form-control" id="foto_unit" value="{{$admin->image}}"
                            aria-describedby="image">
                        <img width="100px" height="100px" class="mt-2" src="{{asset('storage/'.$admin->image) }}">
                    </div>
                    <a type="button" class="btn btn-primary btn-outline-primary"
                        href="{{route('admins.index')}}">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection