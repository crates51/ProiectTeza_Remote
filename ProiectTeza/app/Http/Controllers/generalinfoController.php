<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralInfo;
use App\Rooms;


class generalinfoController extends Controller
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
    public function store(Request $request,$name,$totalRooms)
    {
        // $roomsController = new RoomsController;

        // $roomsController->store();

        $GeneralInfo = new GeneralInfo;
        if($totalRooms > 0)$GeneralInfo->totalRoomsSet = true;
        $GeneralInfo->name = $name;
        $GeneralInfo->totalRooms = $totalRooms;
        $GeneralInfo->save();
        
        $currentInfo = $GeneralInfo->orderby('created_at', 'desc')->first();

        
        return redirect('/')->with('success','Congrats, general info updated, Stage 1/2');
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

    public function cookie($value)
    {
        \Cookie::queue("currentListDisplayed", $value, 60);

        return redirect('/')->with("cookie","lol");
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
