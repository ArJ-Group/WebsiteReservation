@extends('layouts.admin')
@section('content')
<div>
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
    @elseif ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Info!!</strong><span> {{ $message }}</span>
    </div>
    @endif
</div>
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="ti-marker-alt bg-c-yellow"></i>
                <div class="d-inline">
                    <h4 class="mt-3">Edit {{$reservationCustomer->customer->name}}'s Reservation</h4>
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
                <form method="post" action="{{ route('reservation.update', $reservation[0]) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <h5>Customer</h5>
                        <div class="form-group" style="display: flex; justify-content: space-between">
                            <ul class=" list-group list-group-flush">
                                <li class="list-group-item">Name :{{$reservationCustomer->customer->name}}</li>
                                <li class="list-group-item">E-Mail :{{$reservationCustomer->customer->email}}</li>
                                <li class="list-group-item">Phone :{{$reservationCustomer->customer->phone}}</li>
                                <li class="list-group-item">Reservation Time :{{$reservationCustomer->reservation_time}}
                                </li>
                            </ul>
                            <img width="180px" height="180px" style="border-radius: 10%; margin-right: 100px"
                                src="{{asset('storage/'.$reservationCustomer->customer->image)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group row">
                            <label for="reservation_time" class="col-sm-3 col-form-label">Reservation Time</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="reservation_time"
                                    name="reservation_time" placeholder="{{$reservation[0]->reservation_time}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group row">
                            <label for="skill" class="col-sm-3 col-form-label">Services</label>
                            <div class="col-sm-8">
                                <div class="form-control">
                                    @foreach($services as $s)
                                    @if(in_array($s->service_id, $reservationServices))
                                    <input type="checkbox" id="service{{$s->service_id}}" name="service_id[]"
                                        value="{{$s->service_id}}" checked>
                                    <label for="service{{$s->service_id}}">{{$s->name}}</label>
                                    @else
                                    <input type="checkbox" id="service{{$s->service_id}}" name="service_id[]"
                                        value="{{$s->service_id}}">
                                    <label for="service{{$s->service_id}}">{{$s->name}}</label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary btn-outline-primary"
                        href="{{route('reservation.index')}}">back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection