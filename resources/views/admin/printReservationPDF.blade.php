<html>

<head>
    <title>{{$r->customer->name}}'s Reservation</title>
</head>

<body>
    <div>
        <img style="border-radius: 10%; float: right" width="130px"
            src="{{public_path('assets/assetsAdmin/images/logo.png')}}" alt="Theme-Logo" />
        <h5>Detail{{$r->customer->name}}'s Reservation</h5>
        <h6 class="mt-3">Code Reservation: <b>{{$r->reservation_code}}</b></h6>
    </div>
    <div class="container">
        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 5px">
            <div style="float: right;">
                <img width="170px" height="170px" style="border-radius: 50%; "
                    src="{{public_path('storage/'.$r->customer->image)}}">
            </div>
            <h5>Customer</h5>
            <div style="display: flex; justify-content: space-between">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name :{{$r->customer->name}}</li>
                    <li class="list-group-item">E-Mail :{{$r->customer->email}}</li>
                    <li class="list-group-item">Phone :{{$r->customer->phone}}</li>
                    <li class="list-group-item">Reservation Time
                        :{{$r->reservation_time}}</li>
                </ul>
            </div>
        </div>
        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 5px">
            <h5>Services</h5>
            <div>
                <ul class="list-group list-group-flush">
                    @foreach ($reservationServices as $rS)
                    @if ($r->reservation_code == $rS->reservation_code)
                    <li style="display: flex; justify-content: space-between; margin-bottom: -50px"
                        class="list-group-item">
                        <p>Service: {{$rS->service->name}}</p>
                        <br>
                        <p>Price: {{$rS->service->price}}</p>
                        <img width="50px" height="50px" style="border-radius: 50%; float: right"
                            src="{{public_path('storage/'.$r->service->image)}}">
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 5px">
            <h5>Reservation Status</h5>
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
</body>

</html>