<?php

namespace App\Http\Controllers;

use App\Availability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $stored_dates = Availability::where('user_id', $user_id)->get(); //array date salvate a db
        $date = $request['date'];
        
        $is_available = $request['availability'];

        //availability in ingresso = true, ma sara' registrata la NON disponibilita'
        if ($is_available === 'true') {
            $is_available = 0;
        } else {
            $is_available = 1;
        }
        
        //se arriva due volte la stessa data si procede al delete (Action: click sulla stessa casella = annullamento)

        if (count($stored_dates) > 0) { //salvataggio
            $arr_stored_dates = [];

            foreach ($stored_dates as $d) {
                array_push($arr_stored_dates, $d->selected_dates);
            }

            if (in_array($date, $arr_stored_dates)) {

                foreach ($stored_dates as $d) {

                    if ($date === $d->selected_dates) {
                        $d->forceDelete();
                    }
                    
                }
                
            } else {

                $data = new Availability();

                $data->user_id = $user_id;
                $data->selected_dates = $date;
                $data->is_available = $is_available;
        
                $data->save();
      
            }

        } else {
            $data = new Availability();
    
            $data->user_id = $user_id;
            $data->selected_dates = $date;
            $data->is_available = $is_available;
    
            $data->save();
        }


        //riconversione per script cambio colori 
        //(es. si registra la non disponibilita' su una data se la variabile in ingresso e' true e viceversa)

        if ($is_available === 0) {
            $is_available = false;
        } else {
            $is_available = true;
        }


        $stored_dates = Availability::select('selected_dates')->where('user_id', $user_id)->get(); //array date salvate a db

        //variabile per ritornare alla view i giorni salvati come non disponibili
        //variabile per ritornare alla view i giorni salvati come disponibili
        // dd($date);
        return ['is_available' => $is_available, 'date' => $date, 'stored_dates' => $stored_dates];
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
