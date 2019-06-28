<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use App\Bookings;
use App\GeneralInfo;
use App\Rooms;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;


// use DB;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $data = [
            'bookings'              => Bookings::orderBy('bookingId','asc')->paginate(5),
            'totalBookings'         => Bookings::orderBy('created_at','desc')->count(),
            'maximumRooms'          => Bookings::max('totalRooms'),
            'mostRecentCheckin'     => Bookings::max('Checkin'),
            'clients'               => Clients::orderBy('clientId','asc')->paginate(5),
            'totalClients'          => Clients::orderBy('created_at','desc')->count(),
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
            'currentDate'           => date("Y-m-d"),
            'title'                 => "New Booking!"
        ];

        return view('bookings.index')->with('data',$data);
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
            'email' => 'required|email',
            //this validates that the phone number starts with 07 and has 8 more characters after, and has only digits
            'specificRoom' => 'required|numeric|min:1',
            'phone' => 'required|regex:/(07)[0-9]{8}/',
            'adults_number' => 'required|min:1',
            'children_number' => 'required',
            // 'totalRooms' => 'required|numeric|min:1',
            'Check-in' =>'required|date_format:d/m/Y',
            'Check-out'=> 'required|date_format:d/m/Y|after:Check-in',
        ]);

        $booking = new Bookings;
        $client = new Clients;
        $rooms = Rooms::find($request->input('specificRoom'));

        // Looking for free rooms for the client

         if($rooms->available){
            $booking->roomId = $request->input('specificRoom');
            $rooms->available=false;
            $rooms->save();
         }
         else{
            $specificBooking = $booking->where("roomId",$request->input('specificRoom'))->get();

            echo $specificBooking;
            $specificClient = Clients::find($specificBooking[0]->clientId);
                // $request->input('specificRoom')
            // echo "The room is unavailable";
            // echo nl2br ("\n");
            echo $specificClient->Last_Name;

            return redirect('/')->with('error','Room ' .$request->input('specificRoom').' is unavailable. The client '.$specificClient->Last_Name." ".$specificClient->First_Name." is booked there :(");
         };
         


        // Looking for clientId in clients
        // If the booking has the same Last Name && First Name && Phone Number then it's the same person


        $clientsbyPhone = $client->where("Phone",$request->input('phone'))->get();
        $nrOfClientsfound=0;
        $totalClientsinTable = count($client->get());
        $curentClientId;

       foreach($clientsbyPhone as $clientbyPhone){
            if($clientbyPhone->Last_Name == $request->input('nume')
                && $clientbyPhone->First_Name == $request->input('prenume')
                && $clientbyPhone->Email == $request->input('email'))
                    {
                        // echo $clientbyPhone->clientId;
                        $nrOfClientsfound++;                    
                        $curentClientId=$clientbyPhone->clientId;
                    }
            // else{
            //     echo "Phone number didn't find";
            // }
            // echo nl2br ("\n");
        }

                // echo nl2br ("\n");

        if($nrOfClientsfound == 1){
         // echo "Just ".$nrOfClientsfound." client(s) has been found, good news, perceed to the next step :)";
         // echo "The client will get the id ".$curentClientId;
        }
        elseif($nrOfClientsfound ==0){
         // echo "There are no clients with these credentials, adding this client :)";
         $curentClientId=($totalClientsinTable+1);

         $client->Last_Name = $request->input('nume');
         $client->First_Name = $request->input('prenume');
         $client->Email = $request->input('email');
         $client->Phone = $request->input('phone');

         $client->save();
         // echo "The client will get the id ".$curentClientId;
        }
        else{
             echo $nrOfClientsfound." client(s) has been found with these credentials, that's a problem :(";
            return redirect('/')->with('error','Booking for: ' .$request->input('nume'). ' couldn\'t be made ! <br>'.
                                               'Reason: multiple accounts found for this credentials <br>'.
                                               'Please contact us for this issue !');

        }    

        if(($nrOfClientsfound == 1)||($nrOfClientsfound == 0))   
        {
            $booking->clientId = $curentClientId;
             if(auth()->check()){
                $booking->Status = "Booked";
            }
            else{
                $booking->Status = "Pending";
            }
            $booking->Adults = $request->input('adults_number');
            $booking->Children = $request->input('children_number');
            $booking->totalRooms = $request->input('totalRooms');

            // Se formateaza Data in Ani/Luni/Zile pentru phpMyadmin
            // We need to change from xx/xx/xxxx to xx-xx-xxxx
        
            $date1 = str_replace('/', '-', $request->input('Check-in'));
            $date2 = str_replace('/', '-', $request->input('Check-out'));

            $Checkin = date('Y-m-d', strtotime($date1));
            $Checkout = date('Y-m-d', strtotime($date2));
  
            $booking->Checkin = $Checkin;
            $booking->Checkout = $Checkout;

            $booking->save();

            return redirect('/')->with('success','Booking for: ' .$request->input('nume'). ' created successfull !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Bookings::find($id);

        $client = Clients::find($booking->clientId);

       $data = [
                'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
            ];
        return view('bookings.show')->with('booking',$booking)->with('client',$client)->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Bookings::find($id);
        $client = Clients::find($booking->clientId);

        $date1 = str_replace('-', '/', $booking->Checkin);
        $date2 = str_replace('-', '/', $booking->Checkout);

        $checkin  = date('d/m/Y', strtotime($date1));
        $checkout = date('d/m/Y', strtotime($date2));
  
        $check = [
            'in'    => $checkin,
            'out'   => $checkout
        ];

        $data = [
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
        ];

        // echo $checkin;
        // echo nl2br ("\n");
        // echo $checkout;

        //Check for correct user
        // return view('bookings.edit')->with('booking',$booking)->with('client',$client)->with('check',$check)->with('data',$data);
        return view('bookings.edit')->with('booking',$booking)->with('client',$client)->with('check',$check)->with('data',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bookingId)
    {
        $this->validate($request,[
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|digits_between:10,13',
            'adults_number' => 'required',
            'children_number' => 'required',
            'totalRooms' => 'required|numeric|min:1',
            'Check-in' =>'required|date_format:d/m/Y',
            'Check-out'=> 'required|date_format:d/m/Y|after:Check-in',
            'status' => 'required',
        ]);
       
        $booking = Bookings::find($bookingId);
        $client = Clients::find($booking->clientId);

        // $client = Bookings::find($clientId);

        $booking->Adults = $request->input('adults_number');
        $booking->Children = $request->input('children_number');
        $booking->totalRooms = $request->input('totalRooms');
        $booking->Status = $request->input('status');

        $client->First_Name = $request->input('firstName');
        $client->Last_Name = $request->input('lastName');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');

         // echo $request->input('date') . " " . "\r\n";
        //Se formateaza Data in Ani/Luni/Zile pentru phpMyadmin
        // We need to change from xx/xx/xxxx to xx-xx-xxxx
        $date1 = str_replace('/', '-', $request->input('Check-in'));
        $date2 = str_replace('/', '-', $request->input('Check-out'));

        $Checkin = date('Y-m-d', strtotime($date1));
        $Checkout = date('Y-m-d', strtotime($date2));
  
        $booking->Checkin = $Checkin;
        $booking->Checkout = $Checkout;
        
        $booking->save();
        $client->save();

        return redirect('/')->with('success','Booking Updated');


            // return redirect('/')->with('error','This feature is not implemented yet, sorry');
    }

    public function updateSpecific($id,$status)
    {
            $booking = Bookings::find($id);
            $booking->Status = $status;
            $booking->save();
            return redirect('/')->with('success','Booking Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
         if(auth()->user()->name == "admin"){
            $booking = Bookings::find($id);
            $client = Clients::find($booking->clientId);
            // echo "Deleting booking".$booking;
            $room = Rooms::find($booking->roomId);
            
            $room->available = true;
            // echo nl2br ("\n");
            // echo nl2br ("\n");
            // echo "Deleting room ".$room;
            $room->save();


            $booking -> delete();
            DB::select("SET @count = 0");
            DB::select("UPDATE `bookings` SET `bookings`.`bookingId` = @count:= @count + 1");
            DB::select("ALTER TABLE `bookings` AUTO_INCREMENT = 1");

            DB::select("SET @count = 0");
            DB::select("UPDATE `clients` SET `clients`.`clientId` = @count:= @count + 1");
            DB::select("ALTER TABLE `clients` AUTO_INCREMENT = 1");
            return redirect('/')->with('success','Booking for '.$client->Last_Name." has been removed");
            // return redirect('/')->with('success','Test, to replace this!!!');  
         }
         else{
            return redirect('/')->with('error','You\'re not allowed to delete bookings, please speak with an Admin');
         }
    }
}
 