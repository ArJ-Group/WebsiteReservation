<?php

namespace App\Http\Controllers;

use App\Mail\Reservation as MailReservation;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $reservation = Reservation::with('customer', 'service')->search(['reservation_code', 'reservation_time'], $search)->orderBy('reservation_time', 'desc')->groupBy('reservation_code')->get();
        } else {
            $reservation = Reservation::with('customer', 'service')->groupBy('reservation_code')->orderBy('reservation_time', 'desc')->get();
        }
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $service = Service::all();
        $user = User::all();
        return view('admin.reservationIndex', compact('reservation', 'user',  'service', 'reservationServices', 'reservationStatus'));
    }

    public function reservationCustomer()
    {
        $service = Service::all();
        return view('customer.reservation', compact('service'));
    }

    public function searchByCustomer(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $reservation = Reservation::with('customer', 'service')->search(['reservation_code'], $search)->groupBy('reservation_code')->first();
        } else {
            $reservation = "";
        }
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $service = Service::all();
        $r = $reservation;
        if ($reservation !== null) {
            $servicesReservation = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
            $servicesReservation = json_decode(json_encode($servicesReservation), true);
            return view('customer.searchResult', compact('r', 'service', 'reservationServices', 'reservationStatus', 'servicesReservation'));
        } else {
            return redirect()->route('reservationCustomer')
                ->with('fail', 'Reservation Code Not Found!!');
        }
    }


    public function create()
    {
        //
    }




    public function store(Request $request)
    {
        $service_id = $request->get('service_id');
        $user_id = $request->get('user_id');

        if (empty($service_id)) {
            if ($request->get('customer')) {
                return redirect()->route('reservationCustomer')
                    ->with('failr', 'Check the service');
            } else {
                return redirect()->route('reservation.index')
                    ->with('fail', 'Check the service');
            }
        } else {

            $reservation_code = $this->checkIfAva();
            $customer = new Customer;
            if ($request->file('image')) {
                $image = $request->file('image')->store('images', 'public');
                $customer->image = $image;
            }


            $total = 0;
            for ($i = 0; $i < count($service_id); $i++) {
                $reservation = new Reservation;

                $customer = User::where('user_id', $request->user_id)->first();
                $reservation->customer()->associate($customer);

                $service = new Service;
                $service->service_id = $service_id[$i];
                $reservation->service()->associate($service);


                $reservation->reservation_time = $request->get('reservation_time');
                $reservation->reservation_code = $reservation_code;
                $svcprice = Service::where('service_id', $service_id[$i])->first();
                $total += $svcprice->price;


                $reservation->save();
            }

            $reservationStatus = new ReservationStatus;
            $reservationStatus->reservation_code = $reservation_code;
            $reservationStatus->price = $total;
            $reservationStatus->status = 0;
            $reservationStatus->save();

            $reservationStatus = ReservationStatus::all();
            $reservationServices = Reservation::with('service')->get();
            $r = $reservation;

            /*

            if ($request->get('customer')) {
                Mail::to($reservation->customer->email)->send(new MailReservation($r, $reservationServices, $reservationStatus));
                return view(
                    'customer.reservationDetail',
                    compact('r', 'reservationStatus', 'reservationServices')
                );
            }

            Mail::to($reservation->customer->email)->send(new MailReservation($r, $reservationServices, $reservationStatus));
            */
            return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
        }
    }


    public function checkIfAva()
    {
        $reservations = Reservation::all();
        $reservation_code = "RBX" . "-" . $this->random_strings(8);
        $isAva = True;
        for ($i = 0; $i < count($reservations); $i++) {
            if ($reservations[$i]->reservation_code === $reservation_code) {
                $isAva = False;
            } else {
                $isAva = True;
            }
        }
        if ($isAva) {
            return $reservation_code;
        } else {
            $this->checkIfAva();
        }
        return $reservation_code;
    }
    public function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    public function show(Reservation $reservation)
    {
        //
    }


    public function edit(Reservation $reservation)
    {
        $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
        $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
        $reservationServices = json_decode(json_encode($reservationServices), true);
        $reservation = Reservation::where('reservation_code', $reservation->reservation_code)->get();
        $services = Service::all();
        return view('admin.reservationEdit', ['reservation' => $reservation, 'services' => $services, 'reservationServices' => $reservationServices, 'reservationCustomer' => $reservationCustomer]);
    }


    public function update(Request $request, Reservation $reservation)
    {
        $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
        $reservationServicesArray = json_decode(json_encode($reservationServices), true);
        $service_id = $request->get('service_id');
        if (empty($service_id)) {
            return redirect()->route('reservation.edit', $reservation)->with('fail', 'Nothing to Change');
        } else {
            $resultToDelete = array_diff($reservationServicesArray, $service_id);
            $resultToAdd = array_diff($service_id, $reservationServicesArray);
            if (!empty($resultToDelete)) {
                foreach ($resultToDelete as $key) {
                    $reservationsToDelete = Reservation::where('reservation_code', $reservation->reservation_code)->where('service_id', $key)->first();
                    $reservationsToDelete->delete();
                }
            }
            $total = 0;
            $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
            if (!empty($resultToAdd)) {
                foreach ($resultToAdd as $key) {
                    $reservation = new Reservation;
                    $reservation->customer()->associate($reservationCustomer->customer);
                    $service = new Service;
                    $service->service_id = $key;
                    $reservation->service()->associate($service);
                    $reservation->reservation_time = $reservationCustomer->reservation_time;
                    $reservation->reservation_code = $reservationCustomer->reservation_code;
                    $svcprice = Service::where('service_id', $key)->first();
                    $total += $svcprice->price;
                    $reservation->save();
                }
            }
            $reservationStatus = ReservationStatus::where('reservation_code', $reservation->reservation_code)->first();
            if ($reservationStatus) {
                $reservationStatus->price = $reservationStatus->price + $total;
                $reservationStatus->save();
            } else {
                $totalNew = 0;
                foreach ($service_id as $key) {
                    $svcprice = Service::where('service_id', $key)->first();
                    $totalNew += $svcprice->price;
                }
                $reservationStatus = new ReservationStatus;
                $reservationStatus->reservation_code = $reservationCustomer->reservation_code;
                $reservationStatus->price = $totalNew;
                $reservationStatus->status = 0;
                $reservationStatus->save();
            }
            if ($request->get('reservation_time')) {
                $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
                foreach ($reservations as $key) {
                    $key->reservation_time = $request->get('reservation_time');
                    $key->save();
                }
            } else {
                return redirect()->route('reservation.edit', $reservation)->with('info', 'Cheack Reservation Time');
            }
            return redirect()->route('reservation.index', $reservation)->with('success', 'Updated Successfully');
        }
    }

    public function updateByCustomer(Request $request, Reservation $reservation, User $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'nullable',

        ]);
        if ($request->file('image')) {
            if ($customer->image) {
                if ($customer->image !== 'images/userDefault.jpg') {
                    Storage::delete('public/' . $customer->image);
                }
            }
            $image = $request->file('image')->store('images', 'public');
            $customer->image = $image;
        }
        $customer->name = $request->get('name');
        $customer->phone = $request->get('phone');
        $customer->email = $request->get('email');
        $customer->save();

        $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
        $reservationServicesArray = json_decode(json_encode($reservationServices), true);
        $service_id = $request->get('service_id');
        if (empty($service_id)) {
            return redirect()->back()->with('fail', 'Nothing Changed From The Services');
        } else {
            $resultToDelete = array_diff($reservationServicesArray, $service_id);
            $resultToAdd = array_diff($service_id, $reservationServicesArray);
            if (!empty($resultToDelete)) {
                foreach ($resultToDelete as $key) {
                    $reservationsToDelete = Reservation::where('reservation_code', $reservation->reservation_code)->where('service_id', $key)->first();
                    $reservationsToDelete->delete();
                }
            }
            $total = 0;
            $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
            if (!empty($resultToAdd)) {
                foreach ($resultToAdd as $key) {
                    $reservation = new Reservation;
                    $reservation->customer()->associate($reservationCustomer->customer);
                    $service = new Service;
                    $service->service_id = $key;
                    $reservation->service()->associate($service);
                    $reservation->reservation_time = $reservationCustomer->reservation_time;
                    $reservation->reservation_code = $reservationCustomer->reservation_code;
                    $svcprice = Service::where('service_id', $key)->first();
                    $total += $svcprice->price;
                    $reservation->save();
                }
            }
            $reservationStatus = ReservationStatus::where('reservation_code', $reservation->reservation_code)->first();
            if ($reservationStatus) {
                $reservationStatus->price = $reservationStatus->price + $total;
                $reservationStatus->save();
            } else {
                $totalNew = 0;
                foreach ($service_id as $key) {
                    $svcprice = Service::where('service_id', $key)->first();
                    $totalNew += $svcprice->price;
                }
                $reservationStatus = new ReservationStatus;
                $reservationStatus->reservation_code = $reservationCustomer->reservation_code;
                $reservationStatus->price = $totalNew;
                $reservationStatus->status = 0;
                $reservationStatus->save();
            }
            if ($request->get('reservation_time')) {
                $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
                foreach ($reservations as $key) {
                    $key->reservation_time = $request->get('reservation_time');
                    $key->save();
                }
            }
            return redirect()->back()->with('success', 'Updated Successfully');
        }
    }
    public function sendtoCustomer(Reservation $reservation)
    {
        echo $reservation;
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $r = $reservation;
        Mail::to($reservation->customer->email)->send(new MailReservation($r, $reservationServices, $reservationStatus));
        return redirect()->back()->with('success', 'Sent to your email Successfully');
    }
    public function destroy(Request $request, Reservation $reservation)
    {
        $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
        foreach ($reservations as $r) {
            $r->delete();
        }
        if ($request->get('customer')) {
            return redirect()->route('reservationCustomer')
                ->with('success', 'Reservation seccesfully Deleted');
        }
        return redirect()->route('reservation.index')
            ->with('success', 'Reservation seccesfully Deleted');
    }

    public function printReservationPDF(Reservation $reservation)
    {
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $pdf = PDF::loadview('admin.printReservationPDF', ['r' => $reservation, 'reservationStatus' => $reservationStatus, 'reservationServices' => $reservationServices]);
        return $pdf->stream();
    }
}
