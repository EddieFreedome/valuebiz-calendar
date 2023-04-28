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
        
        $availability = $request['availability'];
        
        if ($availability === true) {
            $availability = 1;
        } else {
            $availability = 0;
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
                $data->is_available = $availability;
        
                $data->save();
      
            }

        } else {
            $data = new Availability();
    
            $data->user_id = $user_id;
            $data->selected_dates = $date;
            $data->is_available = $availability;
    
            $data->save();
        }

        //riconversione
        if ($availability === 1) {
            $availability = true;
        } else {
            $availability = false;
        }

        $stored_dates = Availability::select('selected_dates')->where('user_id', $user_id)->get(); //array date salvate a db

        //variabile per ritornare alla view i giorni salvati come non disponibili
        //variabile per ritornare alla view i giorni salvati come disponibili
        // dd($date);
        return ['availability' => $availability, 'date' => $date];
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
