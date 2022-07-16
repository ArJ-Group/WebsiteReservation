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
<center><div style="width: 800px !important">
	<div class="alert alert-success alert-dismissible fade show" role="alert" >
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!!</strong><span> This reservation has been sent to your email : {{$r->customer->email}}</span>
	</div>
</div>
</center>
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

@endsection