<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Bookings;
use App\Clients;
use App\GeneralInfo;
use App\Rooms;
use App\Http\Controllers\Auth;



class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    // If there are no GeneralInfo att all, we will push a default first row into table for comparison
    if(!GeneralInfo::orderBy('created_at','desc')->count()){
        $GeneralInfo = new GeneralInfo;
        $GeneralInfo->save();
    };


        $data = [
            'bookings'              => Bookings::orderBy('bookingId','asc')->paginate(5),
            'rooms'                 => Rooms::all(),
            'totalBookings'         => Bookings::orderBy('created_at','desc')->count(),
            'maximumRooms'          => Bookings::max('totalRooms'),
            'mostRecentCheckin'     => Bookings::max('Checkin'),
            'clients'               => Clients::all(),
            'totalClients'          => Clients::orderBy('created_at','desc')->count(),
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
            'currentDate'           => date("Y-m-d"),
            'title'                 => __("keyphrases.new_booking")
        ];


// Before loading the page, we are checking if the client chekout is before the current time, if yes, his booking is finished
// if no we reset to "Pending" if necessary

        foreach($data['bookings'] as $booking){
            if($booking->Checkout < $data['currentDate']){
                $booking->Status = "Finished";
                $booking->save();
            }
            else{
                if($booking->Status == "Finished"){
                    $booking->Status = "Pending";
                    $booking->save();
                }
            }
        }
        // echo "There are ".Clients::orderBy('created_at','desc')->count()." clients in database";

        // echo nl2br ("\n");
        // echo "Count: ".$data['clients']->count();
        // echo nl2br ("\n");
        // echo nl2br ("\n");

        // foreach($data['clients'] as $client){
        //     echo $client;
        //     echo nl2br ("\n");

        // }

    // if(!GeneralInfo::orderBy('created_at','desc')->count())echo "There are no records";
    // else echo "There are records";


         if(auth()->check()){
            return view('pages.index')->with('data',$data);
        }
        else{
            return view('pages.loginIndex')->with('data',$data);
        }
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
            // 'nume_Familie' => 'required',
            // 'email' => 'required',
            // 'adults_number' => 'required',
            // 'children_number' => 'required',
            // 'room_type' => 'required',
        ]);

        $bookings = new Bookings;
        $bookings->First_Name = $request->input('prenume');
        $bookings->save();

        return redirect('/bookings')->with('success','Cazare Creata');
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
