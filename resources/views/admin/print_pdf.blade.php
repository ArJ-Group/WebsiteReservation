<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <center><h2>Reservation Status</h2></center>
<table class="table table-bordered" id="serviceTable" style="border: 1px solid black">
    <thead>
        <tr>
            <th>Reservation Code</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservationStatus as $rs)
        <tr style="border: 1px solid black">
            <td>{{$rs->reservation_code}}</td>
            <td>{{$rs->price}}</td>
            <td>
                <div id="status{{$rs->reservation_status_id}}">
                    @if($rs->status)
                    Done
                    @else
                    Waiting Customer
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
