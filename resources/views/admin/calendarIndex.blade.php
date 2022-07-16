@extends('layouts.admin')
@section('content')

<div class="page-body">
    <div class="card p-3">
        <div class="" style=" display : flex; justify-content: space-evenly; flex-wrap:wrap">
            <div class="calendarContainer px-3" style="width : 50%; height: 100%">
                <div id="calendar" class="mt-4"></div>
                <form action="{{route('calendar.index')}}" style="display:none" id="formDate">
                    <input type="date" id="selectDate" name="tanggal">
                </form>
            </div>
            <div class="penyewaanContainer"
                style="border-left: 1px solid rgb(221, 221, 221); width : 50%; padding: 10px">
                <h5><b style="color: #00aced"> Reservation In {{$selectDate}} </b>
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <th>Reservation Code</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($reservation)>0)
                            @foreach($reservation as $s)
                            <tr>
                                <td>{{$s->reservation_code}}</td>
                                <td>{{$s->reservation_time}}</td>
                                @foreach ($reservationStatus as $rStatus)
                                @if ($s->reservation_code == $rStatus->reservation_code)
                                <td>Total: {{$rStatus->price}}</td>
                                @if ($rStatus->status)
                                <td>
                                    <div
                                        style="background: rgb(74, 212, 132); color: white; padding: 7px; font-size: 12px;">
                                        Done </div>
                                </td>
                                @else
                                <td>
                                    <div
                                        style="background: rgb(214, 84, 84); color: white; padding: 7px; font-size: 12px;">
                                        Waiting
                                        Customer </div></i>
                                </td>
                                @endif
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                            @else
                            <p>No Reservation: on {{$selectDate}}</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection