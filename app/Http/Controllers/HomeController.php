<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Service;
use App\Models\CategoryService;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('reservation.index');
        } else {
            return redirect('/');
        }
    }
}
