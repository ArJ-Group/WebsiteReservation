@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="ti-marker-alt bg-c-yellow"></i>
                <div class="d-inline">
                    <h4 class="mt-3">Edit Category Service</h4>
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
                <form method="post"
                    action="{{ route('categoryService.update', $categoryService->category_service_id) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Category Service Name</label>
                        <input type="text" class="form-control" id="name" value="{{$categoryService->name}}"
                            placeholder="Masukkan code unit" name="name">
                    </div>
                    <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" name="image" class="form-control" id="foto_unit"
                            value="{{$categoryService->image}}" aria-describedby="image">
                        <img width="150px" height="100px" class="mt-2"
                            src="{{asset('storage/'.$categoryService->image) }}">
                    </div>
                    <a type="button" class="btn btn-primary btn-outline-primary"
                        href="{{route('categoryService.index')}}">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection