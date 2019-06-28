<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralInfo;
use App\Rooms;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "rooms index";
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
        $GeneralInfo = new GeneralInfo;
        $currentInfo = GeneralInfo::orderby('created_at', 'desc')->first();

        for ($i=1; $i <= $currentInfo->totalRooms; $i++) { 

            $Room = new Rooms;

            $Room->nrOfBeds = $request->input('numberOfBeds_'.$i);

            if($request->input('seaSight_'.$i) == NULL)$Room->seaSight = false;
            else $Room->seaSight = $request->input('seaSight_'.$i);
            
            if($Room->available = $request->input('available_'.$i) == NULL)$Room->available = false;
            else $Room->available = $request->input('available_'.$i);

            $Room->save();
        }

        $GeneralInfo->name = $currentInfo->name;
        $GeneralInfo->totalRooms = $currentInfo->totalRooms;
        $GeneralInfo->totalRoomsSet = $currentInfo->totalRoomsSet;
        $GeneralInfo->allRoomsPrepared = true;
        $GeneralInfo->save();

        return redirect('/')->with('success','Congrats, general info updated, Stage 2/2, Finished :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
