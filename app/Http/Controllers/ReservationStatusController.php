<?php

namespace App\Http\Controllers;

use App\Models\ReservationStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;
use PDF;

class ReservationStatusController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $reservationStatus = ReservationStatus::search(['reservation_code', 'price'], $search)->get();
        } else {
            $reservationStatus = ReservationStatus::all();
        }
        return view('admin.reservationStatusIndex', compact('reservationStatus'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(ReservationStatus $reservationStatus)
    {
        //
    }


    public function edit(ReservationStatus $reservationStatus)
    {
        //
    }


    public function update(Request $request, $idrStatus)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $rStatus = ReservationStatus::where('reservation_status_id', $idrStatus)->first();
        $rStatus->status = $request->get('status');
        $rStatus->save();

        return redirect()->route('reservationStatus.index')
            ->with('success', 'Status Successfully Updated');
    }


    public function destroy($idrStatus)
    {
        $code = ReservationStatus::where('reservation_status_id', $idrStatus)->value('reservation_code');
        $reservations = Reservation::where('reservation_code', $code)->get();
        foreach ($reservations as $r) {
            $r->delete();
        }
        return redirect()->route('reservationStatus.index')
            ->with('success', 'Reservation Status seccesfully Deleted');
    }

    public function print_pdf()
    {

        $reservationStatus = ReservationStatus::with('reservation')->get();
        $pdf = PDF::loadview('admin.print_pdf', ['reservationStatus' => $reservationStatus]);
        return $pdf->stream();
    }
}
