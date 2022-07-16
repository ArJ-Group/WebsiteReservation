@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Services</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Services</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Best Pricing</p>
            <h2>We Provide Best Price in the City</h2>
        </div>
        <div class="row">
            @if (count($services)<=0) <center>
                <h2>There are no Services</h2>
                </center>
                @else
                @foreach ($services as $service)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="price-item">
                        <div class="price-img">
                            <img src="{{ asset('storage/'.$service->image) }}" alt="Image">
                        </div>
                        <div class="price-text">
                            <h2>{{$service->name}}</h2>
                            <h3>Rp.{{$service->price}}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>
@endsection