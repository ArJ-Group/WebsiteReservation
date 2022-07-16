<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {

        $date = $request->tanggal;
       if ($date) {
            $reservation = Reservation::with('reservationStatus')->search(['reservation_time'], $date)->orderBy('reservation_time', 'desc')->groupBy('reservation_code')->get();
            $selectDate = $date;
        }
        else{

            $today = Carbon::now()->toDateString();
            $reservation = Reservation::with('reservationStatus')->search(['reservation_time'], $today)->orderBy('reservation_time', 'desc')->groupBy('reservation_code')->get();
            $selectDate = $today;
        }
        $reservationStatus = ReservationStatus::all();
        return view('admin.calendarIndex', compact('reservation', 'selectDate', 'reservationStatus'));
    }
}
