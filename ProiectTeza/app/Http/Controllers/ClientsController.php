<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
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
         $this->validate($request,[
            'prenume' => 'required',
            'nume' => 'required',
            'email' => 'required|email',
            //this validates that the phone number starts with 07 and has 8 more characters after, and has only digits
            'phone' => 'required|regex:/(07)[0-9]{8}/',
           

        ]);

        $client = new Clients;
        $client->Last_Name = $request->input('nume');
        $client->First_Name = $request->input('prenume');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');

        $booking->save();
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
        $this->validate($request,[
            'prenume' => 'required',
            'nume' => 'required',
            'email' => 'required|email',
            //this validates that the phone number starts with 07 and has 8 more characters after, and has only digits
            'phone' => 'required|regex:/(07)[0-9]{8}/',
           

        ]);

        $client = new Clients;
        $client->Last_Name = $request->input('nume');
        $client->First_Name = $request->input('prenume');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');

        $booking->save();
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
