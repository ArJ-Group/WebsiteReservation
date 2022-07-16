@extends('layouts.admin')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="ti-marker-alt bg-c-yellow"></i>
                <div class="d-inline">
                    <h4 class="mt-3">Edit Service</h4>
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
                    action="{{ route('service.update', $service->service_id) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Service Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" value = "{{$service->name}}"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_service_id" class="col-sm-3 col-form-label">Category Service</label>
                        <div class="col-sm-8">
                            <select name="category_service_id" id="category_service_id" class="form-control">
                                @foreach($categoryService as $cs)
                                <option value="{{$cs->category_service_id}}">{{$cs->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="price">Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price" value = "{{$service->price}}" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="image">Photo</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="image" value = "{{$service->image}}" name="image">
                            <img width="100px" height="100px" class="mt-2"
                            src="{{asset('storage/'.$service->image) }}">
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary btn-outline-primary"
                        href="{{route('service.index')}}">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection