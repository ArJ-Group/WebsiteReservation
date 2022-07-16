<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\CategoryService;
use App\Models\Employee;
use Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            echo $search;
            $admins = User::where('name', $search)->Where('is_admin', true)->get();
        } else {
            $admins = User::where('is_admin', true)->get();
        }
        return view('admin.adminIndex', compact('admins'));
    }



    public function profile($iduser)
    {
        // $idUser = Auth::User->user_id;
        $user = User::where('user_id', $iduser)->first();
        return view('admin.profile', compact('user'));
    }

    public function updateImage(Request $request, $iduser)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $user = User::where('user_id', $iduser)->first();
        if ($request->file('image')) {
            Storage::delete('public/' . $user->image);
            $image = $request->file('image')->store('images', 'public');
            $user->image = $image;
        }

        $user->save();
        return redirect()->route('user.profile', $iduser)
            ->with('success', 'Profile Photo updated');
    }

    public function updateBio(Request $request, $iduser)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::where('user_id', $iduser)->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();
        return redirect()->route('user.profile', $iduser)
            ->with('success', 'Profile Photo updated');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $admin = new User;
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $admin->image = $image;
        }

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password =  Hash::make($request->get('password'));
        $admin->save();


        return redirect()->route('admins.index')
            ->with('success', 'New Admin Added Succesfully');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $admin)
    {
        return view('admin.adminEdit', ['admin' => $admin]);
    }


    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'nullable',

        ]);
        if ($request->file('image')) {
            if ($admin->image) {
                if ($admin->image !== 'images/userDefault.jpg') {
                    Storage::delete('public/' . $admin->image);
                }
                $image = $request->file('image')->store('images', 'public');
                $admin->image = $image;
            }
        }

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->save();

        return redirect()->route('admins.index')
            ->with('success', 'Admin seccesfully Updated');
    }


    public function destroy(User $admin)
    {
        if ($admin->image !== 'images/userDefault.jpg') {
            Storage::delete('public/' . $admin->image);
        }
        $admin->delete();
        return redirect()->route('admins.index')
            ->with('success', 'Admin seccesfully Deleted');
    }
    public function indexCustomer()
    {
        $msg = Message::where('show', 1)->get();
        $employee = Employee::get();
        $service = Service::get();
        $serviceCategory = CategoryService::get();
        return view('home', compact('msg', 'employee', 'service', 'serviceCategory'));
    }
}
