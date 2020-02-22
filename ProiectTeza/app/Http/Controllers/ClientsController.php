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
        //  $this->validate($request,[
        //     'prenume' => 'required',
        //     'nume' => 'required',
        //     'email' => 'required|email',
        //     //this validates that the phone number starts with 07 and has 8 more characters after, and has only digits
        //     'phone' => 'required|regex:/(07)[0-9]{8}/',
           

        // ]);

        $client = new Clients;
        // Se verifica daca numarul de telefon este unic
        $clientsbyPhone = $client->where("Phone",$request->input('phone'))->get();
        
        $clientFound=null;
        
        if(count($clientsbyPhone)==1){
            $clientFound=$clientsbyPhone[0];    
            if(!$request->input('client_choosed')){
            return (['status' => 'alreadyExists','clientFound' => $clientFound, 'clients' => Clients::all()]);
            }
        }

        $client->Last_Name = $request->input('last_name');
        $client->First_Name = $request->input('first_name');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');

        $client->save();
        return (['status' => 'uploaded', 'client' =>  $client]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function getAll()
    {
        return (['status' => 'success','clients' => Clients::all()]);
    }

    public function getById($id)
    {
        return (['status' => 'success','client' => Clients::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $client = Clients::find($id);
        $client->First_Name = $request->input('first_name');
        $client->Last_Name = $request->input('last_name');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');
        $client->save();
        
        return (['status' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($clientId)
    {
            $client = Clients::find($clientId);
            
            $client -> delete();
            DB::update("SET @count = 0");
            DB::update("UPDATE `bookings` SET `bookings`.`bookingId` = @count:= @count + 1");
            DB::update("ALTER TABLE `bookings` AUTO_INCREMENT = 1");

            DB::update("SET @count = 0");
            DB::update("UPDATE `clients` SET `clients`.`clientId` = @count:= @count + 1");
            DB::update("ALTER TABLE `clients` AUTO_INCREMENT = 1");

            return (['status' => 'destroyed', 'clientDestroyed' =>  $client]);
        // return (['status' => 'destroyed']);
    }
}
