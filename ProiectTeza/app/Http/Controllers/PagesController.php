<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Bookings;
use App\Clients;
use App\GeneralInfo;
use App\Rooms;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
            'allBookings'           => Bookings::all(),//This is for when i need to retrieve all the bookings
            'rooms'                 => Rooms::all(),
            'totalBookings'         => Bookings::orderBy('created_at','desc')->count(),
            'maximumRooms'          => Bookings::max('totalRooms'),
            'mostRecentCheckin'     => Bookings::max('Checkin'),
            'clients'               => Clients::all(),
            'totalClients'          => Clients::orderBy('created_at','desc')->count(),
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
            'currentDate'           => date("Y-m-d"),
            'title'                 => __("keyphrases.new_booking"),
            'today'                 => Carbon::today(),
        ];

        if(Carbon::today()->month==1){
            $data['current_month']="Ianuarie";
        }
        else if(Carbon::today()->month==2){
            $data['current_month']="Februarie";
        }
        else if(Carbon::today()->month==3){
            $data['current_month']="Martie";
        }
        else if(Carbon::today()->month==4){
            $data['current_month']="Aprilie";
        }
        else if(Carbon::today()->month==5){
            $data['current_month']="Mai";
        }
        else if(Carbon::today()->month==6){
            $data['current_month']="Iunie";
        }
        else if(Carbon::today()->month==7){
            $data['current_month']="Iulie";
        }
        else if(Carbon::today()->month==8){
            $data['current_month']="August";
        }
        else if(Carbon::today()->month==9){
            $data['current_month']="Septembrie";
        }
        else if(Carbon::today()->month==10){
            $data['current_month']="Octombrie";
        }
        else if(Carbon::today()->month==11){
            $data['current_month']="Noiembrie";
        }
        else if(Carbon::today()->month==12){
            $data['current_month']="Decembrie";
        }

// Before loading the page, we are checking if the client chekout is before the current time, if yes, his booking is finished
// if no we reset to "Pending" if necessary

        foreach($data['bookings'] as $booking){
            if($data['currentDate'] < $booking->Checkout ){
                if($data['currentDate'] >= $booking->Checkin ){
                    $booking->Status = "During the stay";
                    $booking->save();    
                }
            }
            else if($data['currentDate'] > $booking->Checkout ){
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

        // $maxfloorId = DB::table('rooms')->max('floorId');
        // echo "MaxFloorId is: ".$maxfloorId;

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
