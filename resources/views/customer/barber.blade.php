@extends('layouts.customer')

@section('hero')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Barber</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Barber</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Barber Team</p>
            <h2>Meet Our Hair Cut Expert Barber</h2>
        </div>
        <div class="row">
            @if (count($employees)<=0) <center>
                <h2>There are no Employees</h2>
                </center>
                @else
                @foreach ($employees as $employee)
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('storage/'.$employee->image) }}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{$employee->name}}</h2>
                            <p>{{$employee->skill}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>

@endsection