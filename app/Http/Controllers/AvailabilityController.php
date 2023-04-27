<?php

namespace App\Http\Controllers;

use App\Availability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //storing logics
        $user_id = Auth::id();
        $availability_raw = $request['availability'];
        $availability = $request['availability'];
        if ($availability === true) {
            $availability = 1;
        } else {
            $availability = 0;
        }

        $d = Carbon::parse($request['date'])->format('Y-M-d');
        $date = new Carbon($d);
        $str_date = $date->toDateString();
        $form_date = $date->format('Y/m/d');
        // $date_new = Carbon::createFromFormat()$date->toString(); 
        dd($form_date);

        $data = new Availability();

        $data->user_id = $user_id;
        $data->selected_dates = $str_date;
        $data->is_available = $availability;

        $data->save();
        // dd($request->all());
        //variabile per ritornare alla view i giorni salvati come non disponibili
        //variabile per ritornare alla view i giorni salvati come disponibili
        
        return $availability_raw;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function show(Availability $availability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function edit(Availability $availability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Availability $availability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Availability $availability)
    {
        $user_id = Auth::id();
        $availabilities = Availability::where('user_id', $user_id)->get();

        foreach ($availabilities as $av) {
            $av->forceDelete();
        }
    }
}
