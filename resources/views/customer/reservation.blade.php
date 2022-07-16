@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Reservation</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Reservation</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="section-header text-center" style="margin-top: 90px;">
    <p>Your Hair is Your Style</p>
    <h2>Make a Reservation and Make Your Hair Trendy!</h2>
    <h3>Use our app to make reservation</h3>
</div>
<div width="700px">
    <center>
        <div width="700px">
            @if ($message = Session::get('fail'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed!!</strong><span> {{ $message }}</span>
            </div>
            @elseif ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!!</strong><span> {{ $message }}</span>
            </div>
            @endif
        </div>
    </center>
</div>
<div class="searchReservation text-center">
    <div class="titleContainer">
        <h3>Search For Reservation</h3>
    </div>
    <div class="searchContainer">
        <div>
            <form action="{{route('searchByCustomer')}}" method="get" class="searchForm">
                @csrf
                <div class="pcoded-search-box d-flex">
                    <input class="inputSearch" name="search" type="text" class="mr-3" placeholder="Search">
                    <span>
                        <button class="buttonSearch" class="btn btn-info"><i class="fa fa-search icon-search"
                                style="font-size:24px"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="formContainer">
    <div class="formReservation">
        <div style="text-align: center">
            <h3 class="main-title">Add New Reservation</h3>
        </div>
        @if ($message = Session::get('failr'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed!!</strong><span> {{ $message }}</span>
</div>
@elseif ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!!</strong><span> {{ $message }}</span>
</div>
@endif
<div class="content-form">
    <form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf
        <h4 class="sub-title">Customer Bio</h4>
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Customer Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" placeholder="Enter Customer Name" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="image">Photo</label>
            <div class="col-sm-9">
                <button onclick="$('#image').click(); return false;" class="btn btn-sm btn-dark buttonAddPhoto">Add
                    Photo</button>
                <input style="display:none" disabled type="text" class="form-control" id="photoCustomer"
                    placeholder="Click Add Photo to Add Photo" name="photoName">
                <input type="file" style="display:none" class="form-control" id="image" placeholder="Upload Image"
                    name="image">
            </div>
        </div>
        <h4 class="sub-title">Service</h4>
        <div class="form-group row">
            <label for="service_id" class="col-sm-3 col-form-label">Service</label>
            <div class="col-sm-9">
                <div class="checkboxContainer">
                    @foreach($service as $s)
                    <div class="serviceBiggerBox" style="display: flex">
                        <input type="checkbox" id="service{{$s->service_id}}" class="checkboxService"
                            name="service_id[]" value="{{$s->service_id}}">
                        <div class="col-lg-3 col-md-5 col-sm-6">
                            <div class="serviceBox">
                                <div class="">
                                    <img src="{{asset('storage/'.$s->image) }}" alt="Image" width="50px">
                                </div>
                                <div class="labelService">
                                    <h2 class="serviceName">{{$s->name}}</h2>
                                    <h3 class="servicePrice">R{{$s->price}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="reservation_time" class="col-sm-3 col-form-label">Reservation Time</label>
            <div class="col-sm-9">
                <input type="datetime-local" class="form-control" id="reservation_time"
                    placeholder="Enter Reservation Time" name="reservation_time">
            </div>
        </div>
        <input type="text" name="customer" value="1" style="display: none">
        <div>
            <button type="submit" class="btn-reservation">Reserve</button>
        </div>
    </form>
</div>
</div>
</div> --}}
<script>
    + function($) {
    'use strict';
    var inputImage = document.getElementById('image');
    var p = document.getElementById('photoCustomer');
    inputImage.onchange = function() {
        p.style.display = '';
        p.value = inputImage.files[0].name;
    }
    }(jQuery);
</script>
@endsection