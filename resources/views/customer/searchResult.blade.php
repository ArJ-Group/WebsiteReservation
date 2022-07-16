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
				<a href="">Your Reservation</a>
			</div>
		</div>
	</div>
</div>
@endsection


@section('content')
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
<div class="" id="reservation{{$r->reservation_id}}" tabindex="-1" role="dialog"
	aria-labelledby="reservation{{$r->reservation_id}}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div>
					<h5 class="modal-title" id="exampleModalLongTitle">Detail
						{{$r->customer->name}}'s Reservation</h5>
					<h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
				</div>
				<a style="border-radius:5px" class="btn btn-sm btn-success" href="{{route('printReservationPDF', $r)}}"
					target="_blank" rel="noopener noreferrer">Print
					PDF</a>
			</div>
			<div class="modal-body">
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
					<h5 class="modal-title" id="exampleModalLongTitle">Customer</h5>
					<div style="display: flex; justify-content: space-between">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Name :{{$r->customer->name}}</li>
							<li class="list-group-item">E-Mail :{{$r->customer->email}}</li>
							<li class="list-group-item">Phone :{{$r->customer->phone}}</li>
							<li class="list-group-item">Reservation Time
								:{{$r->reservation_time}}</li>
						</ul>
						<img class="float-right my-2" width="170px" height="170px" style="border-radius: 10%"
							src="{{asset('storage/'.$r->customer->image)}}">
					</div>
				</div>
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
					<h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
					<div>
						<ul class="list-group list-group-flush">
							@foreach ($reservationServices as $rS)
							@if ($r->reservation_code == $rS->reservation_code)
							<li style="display: flex; justify-content: space-between" class="list-group-item">
								Service: {{$rS->service->name}}<br>
								Price: {{$rS->service->price}}
								<img width="50px" height="50px" style="border-radius: 10%"
									src="{{asset('storage/'.$rS->service->image)}}"></li>
							@endif
							@endforeach
						</ul>
					</div>
				</div>
				<div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px">
					<h5 class="modal-title" id="exampleModalLongTitle">Reservation Status</h5>
					<div>
						<ul class="list-group list-group-flush">
							@foreach ($reservationStatus as $rStatus)
							@if ($r->reservation_code == $rStatus->reservation_code)
							<li class="list-group-item">Total: {{$rStatus->price}}</li>
							@if ($rStatus->status)
							<li class="list-group-item">Status: Done</li>
							@else
							<li class="list-group-item">Status: Waiting Customer</li>
							@endif
							@endif
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="reservationEditForm" tabindex="-1" role="dialog" aria-labelledby="reservationEditForm"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" >
			<div class="modal-header" style = "background: #d5b981">
				<div>
					<h5 class="modal-title" id="exampleModalLongTitle">Detail
						{{$r->customer->name}}'s Reservation</h5>
					<h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
				</div>
			</div>
			<div class="modal-body" style = "background: #1d2434">
				<div style="text-align: center">
					<h4 class="main-title" style="margin-top: 0">Edit Your Reservation</h4>
				</div>
				<div class="content-form" style="padding: 0px 40px;">
					<form method="POST"
						action="{{ route('reservation.updateByCustomer', ['reservation'=>$r, 'customer'=>$r->customer]) }}"
						id="myForm" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<h5 class="sub-title">Customer Bio</h5>
						<div class="d-flex" style="gap: 10px; width: 900px" >
							<div class="form-group">
								<label for="name" class="col-form-label">Customer Name</label>
								<input type="text" class="form-control" id="name" placeholder="Enter Customer Name"
									name="name" value="{{$r->customer->name}}">
							</div>
							<div class="form-group">
								<label for="email" class="col-form-label">E-mail</label>
								<input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email"
									value="{{$r->customer->email}}">
							</div>
							<div class="form-group">
								<label for="phone" class="col-form-label">Phone</label>
								<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone"
									value="{{$r->customer->phone}}">
							</div>
						</div>
						<img class="float-right" width="100px" height="100px" style="border-radius: 10%"
							src="{{asset('storage/'.$r->customer->image)}}">
						<div class="form-group">
							<label class="col-form-label" for="image">Photo</label><br>
							<button style="float: none" onclick="$('#image').click(); return false;"
								class="btn btn-sm btn-dark buttonAddPhoto">Change
								Photo</button>
							<input style="display:none" disabled type="text" class="form-control" id="photoCustomer"
								placeholder="Click Add Photo to Add Photo" name="PhotoName">
							<input type="file" style="display:none" class="form-control" id="image"
								placeholder="Upload Image" name="image" style="width: 70px !important" value="{{$r->customer->image}}">
						</div>
						<div class="form-group row" style="margin-top: 20px">
							<label for="reservation_time" class="col-form-label">Reservation Time</label>
							<input type="datetime-local" class="form-control" id="reservation_time"
								placeholder="Enter Reservation Time" name="reservation_time">
							<p style="color: rgb(207, 207, 207); margin-top: 5px">Your Reservation Time: {{$r->reservation_time}}</p>
						</div>
						<h5 class="sub-title">Service</h5>
						<div class="form-group">
							<label for="service_id" class="col-form-label">Service</label>
							<div class="checkboxContainer">
								@foreach($service as $s)
								@if(in_array($s->service_id, $servicesReservation))
								<div class="serviceBiggerBox" style="display: flex">
									<input type="checkbox" id="service{{$s->service_id}}" class="checkboxService"
										name="service_id[]" value="{{$s->service_id}}" checked>
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
								@else
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
								@endif
								@endforeach
							</div>
						</div>
						<input name="search" type="text" style="display: none" value="{{$r->reservation_code}}">
						<div>
							<button type="submit" class="btn-reservation">Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="buttonContainer" style="display: flex; justify-content: center">
	<button data-target="#reservationEditForm" data-toggle="modal" type="button" class=" button-edit">
		Edit Reservation
	</button>
	<form action="{{ route('reservation.destroy', $r) }}" method="POST">
		@csrf
		@method('DELETE')
		<input type="hidden" name="customer" value="1" id="">
		<button class=" button-delete">
			Delete Reservation
		</button>
	</form>
	<form action="{{ route('reservation.email', $r) }}" method="POST">
		@csrf
		<button class=" button-email">
			Send to my Email
		</button>
	</form>
</div>
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