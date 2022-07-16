<div class="col-md-6">
    <div class="top-bar-left">
        <div class="text">
            <p>Opening Hour Mon - Fri</p>
            <h2>8:00 - 9:00</h2>
        </div>
        <div class="text">
            <p>Call Us For Appointment</p>
            <h2>+123 456 7890</h2>
        </div>
    </div>
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
            </div>
            <div class="modal-body">
                <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer</h5>
                    <div style="display: flex">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name :{{$r->customer->name}}</li>
                            <li class="list-group-item">E-Mail :{{$r->customer->email}}</li>
                            <li class="list-group-item">Phone :{{$r->customer->phone}}</li>
                            <li class="list-group-item">Reservation Time
                                :{{$r->reservation_time}}</li>
                        </ul>
                        <img class="float-right my-2" width="170px" height="170px" style="border-radius: 10%"
                            src="{{$message->embed(storage_path('app/public/'.$r->customer->image))}}">
                    </div>
                </div>
                <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                    <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                    <div>
                        <ul class="list-group list-group-flush" style="display: flex;">
                            @foreach ($reservationServices as $rS)
                            @if ($r->reservation_code == $rS->reservation_code)
                            <li class="list-group-item">
                                Service: {{$rS->service->name}}<br>
                                Price: {{$rS->service->price}}</li>
                            <img width="50px" height="50px" style="border-radius: 10%"
                                src="{{$message->embed(storage_path('app/public/'.$rS->service->image))}}">
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
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-contact">
                            <h2>Salon Address</h2>
                            <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                            <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                            <p><i class="fa fa-envelope"></i>info@example.com</p>
                            <div class="footer-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container copyright">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <a href="#">Barber X</a>, All Right Reserved.</p>
            </div>
            <div class="col-md-6">
                <p>Designed By <a href="https://htmlcodex.com">HTML Codex, Omar and Widiareta</a></p>
            </div>
        </div>
    </div>
</div>