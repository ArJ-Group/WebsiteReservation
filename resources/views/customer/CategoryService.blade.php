@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Category Service</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Category Service</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Salon Services</p>
            <h2>Best Salon and Barber Services for You</h2>
        </div>
        <div class="row">
            @if (count($categoryService)<=0) <center>
                <h2>There are no Category Services</h2>
                </center>
                @else
                @foreach ($categoryService as $cs)
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('storage/'.$cs->image)}}" alt="Image">
                        </div>
                        <h3>{{$cs->name}}</h3>
                        <a class="btn" href="{{route('serviceCustomer')}}">Learn More</a>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>

@endsection