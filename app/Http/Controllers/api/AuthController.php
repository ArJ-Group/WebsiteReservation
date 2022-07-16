<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (!$user) {
            throw ValidationException::withMessages([
                'name' => ['There is something wrong with your input.'],
                'email' => ['There is something wrong with your input.'],
            ]);
        } else {
            $services = Service::all();
            $data = array($user, $services);
            return $data;
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->login)
            ->orwhere('username', $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->is_admin) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials are incorrect.'],
            ]);
        }
        $services = Service::all();
        $data = array($user, $services);
        return $data;
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->tokens()->delete();
        }

        return response()->noContent();
    }


    public function updateDataAkun($id, Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',

        ]);
        $user = User::where('user_id', $id)->first();
        $user->username = $request->get('username');
        $user->name = $request->get('username');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $services = Service::all();
        if (!$user->save()) {
            $services = Service::all();
            $data = array($user, $services);
            return $data;
        } else {
            $services = Service::all();
            $data = array($user, $services);
            return $data;
        }
    }

    public function updatePassword($id, Request $request)
    {
        $request->validate([
            'oldPassowed' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],

        ]);
        $user = User::where('user_id', $id)->first();
        if ($request->oldPassowed == $request->password) {
            throw ValidationException::withMessages([
                'password' => ['Password tidak dapat diubah karena password yang lama sama yang baru'],
            ]);
            $services = Service::all();
            $data = array($user, $services);
            return $data;
        } else {
            if (Hash::check($request->oldPassowed, $user->password)) {
                $user->password = Hash::make($request->get('password'));
                $services = Service::all();
                if (!$user->save()) {
                    $services = Service::all();
                    $data = array($user, $services);
                    return $data;
                } else {
                    $services = Service::all();
                    $data = array($user, $services);
                    return $data;
                }
            } else {
                throw ValidationException::withMessages([
                    'password' => ['Password yang lama tidak sama.'],
                ]);
                $services = Service::all();
                $data = array($user, $services);
                return $data;
            }
        }
    }
}
