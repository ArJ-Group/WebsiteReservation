<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $customers = User::search(['name', 'email', 'phone'], $search)->get();
        } else {
            $customers = User::where('is_admin', false)->get();
        }

        $customer =Customer::all();
        return view('admin.customerIndex', compact('customers','customer'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:user',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'phone' => 'required',
            'image' => 'nullable',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $user->image = $image;
        }
        $user->save();
        return redirect()->route('customer.index')
            ->with('success', 'New Customer Added Succesfully');
    }


    public function show(Customer $customer)
    {
        //
    }


    public function edit(User $customer)
    {
        return view('admin.customerEdit', ['customer' => $customer]);
    }


    public function update(Request $request, User $customer)
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

        return redirect()->route('customer.index')
            ->with('success', 'Customer seccesfully Updated');
    }


    public function destroy(User $customer)
    {
        if ($customer->image !== 'images/userDefault.jpg') {
            Storage::delete('public/' . $customer->image);
        }
        $customer->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer seccesfully Deleted');
    }
}
