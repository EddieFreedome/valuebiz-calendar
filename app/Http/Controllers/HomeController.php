<?php

namespace App\Http\Controllers;

use App\Availability;
use Illuminate\Http\Request;
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
        //disponibilita' settata di default a true
        $availability = true;

        $user_id = Auth::id();
        $stored_dates = Availability::select('selected_dates', 'is_available')->where('user_id', $user_id)->get()->toArray(); //array date salvate a db


        // dd($stored_dates);
        return view('home', compact('availability', 'stored_dates'));
    }
}
