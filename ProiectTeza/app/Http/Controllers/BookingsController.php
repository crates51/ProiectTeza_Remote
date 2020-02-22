<?php
// echo nl2br ("\n");

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
            // 'currentDate'           => date("Y-m-d"),
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
        //  $this->validate($request,[
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required|email',
        //     //this validates that the phone number starts with 07 and has 8 more characters after, and has only digits
        //     'specificRoom' => 'required|numeric|min:1',
        //     'phone' => 'required|regex:/(07)[0-9]{8}/',
        //     'adults' => 'required|min:1',
        //     'children' => 'required',
        //     'check_in' =>'required|date_format:d/m/Y',
        //     'check_out'=> 'required|date_format:d/m/Y|after:check_in',
        // ]);

        $booking = new Bookings;
        $client = new Clients;

        $clientsbyPhone = $client->where("Phone",$request->input('phone'))->get();
        
        $clientFound=null;
        
        if(count($clientsbyPhone)==1){
            $clientFound=$clientsbyPhone[0];    
            if(!$request->input('client_choosed')){
            return (['status' => 'alreadyExists','clientFound' => $clientFound, 'bookings' =>  Bookings::all(), 'clients' => Clients::all()]);
            }
        }
        if(count($clientsbyPhone)==0){
                $client->Last_Name = $request->input('last_name');
                $client->First_Name = $request->input('first_name');
                $client->Email = $request->input('email');
                $client->Phone = $request->input('phone');
                $client->save();
                $clientFound=$client;
        }
        else if(count($clientsbyPhone) > 1){
            echo "S-au gasit mai multi clienti pentru acest numar";
            return (['status' => 'updated', 'bookings' =>  Bookings::all(), 'clients' => Clients::all()]);
        }
        $booking->clientId = $clientFound->clientId;
        $booking->roomId = $request->input('specificRoom');
        $booking->Status = "Booked";
        $booking->Adults = $request->input('adults');
        $booking->Children = $request->input('children');
        $booking->Checkin = $request->input('check_in');
        $booking->Checkout = $request->input('check_out');
        $booking->unique_bookingId = password_hash($booking->clientId, PASSWORD_DEFAULT);
        $booking->save();

        // $unique_bookingId = password_hash($booking->clientId, PASSWORD_DEFAULT);

        return (['status' => 'updated', 'booking' =>  $booking , 'client' => $clientFound ,'bookings' =>  Bookings::all(), 'clients' => Clients::all()]);
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

        // $date1 = str_replace('-', '/', $booking->Checkin);
        // $date2 = str_replace('-', '/', $booking->Checkout);

// comentata pe data de 01/01/2020 ora 18:43
        // $checkin  = date('d/m/Y', strtotime($date1));
        // $checkout = date('d/m/Y', strtotime($date2));
  
        // $check = [
        //     'in'    => $booking->Checkin
        //     'out'   => $booking->Checkout
        // ];

        $data = [
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
        ];
        return view('bookings.edit')->with('booking',$booking)->with('client',$client)->with('data',$data);

        // return view('bookings.edit')->with('booking',$booking)->with('client',$client)->with('check',$check)->with('data',$data);
    }

    /**
     *   the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bookingId)
    {


        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|digits_between:10,13',
            'adults' => 'required',
            'children' => 'required',
            // 'totalRooms' => 'required|numeric|min:1',
            'check_in' =>'required|date_format:d/m/Y',
            // 'check_out'=> 'required|date_format:d/m/Y',
            'check_out'=> 'required|date_format:d/m/Y|after:check_in',
            'status' => 'required',
            'specificRoom' => 'required'
        ]);

        $booking = Bookings::find($bookingId);
        $client = Clients::find($booking->clientId);

        $booking->Adults = $request->input('adults');
        $booking->Children = $request->input('children');

        $booking->Status = $request->input('status');

        $client->First_Name = $request->input('first_name');
        $client->Last_Name = $request->input('last_name');
        $client->Email = $request->input('email');
        $client->Phone = $request->input('phone');

        $booking->Checkin = $request->input('check_in');
        $booking->Checkout = $request->input('check_out');

        // IF/WHEN CHANGING ROOMS
        if($booking->roomId != $request->input('specificRoom')){
        
            $booking->roomId = $request->input('specificRoom');
            $booking->save();
            $client->save();
    
            return (['status' => 'updated', 'bookings' =>  Bookings::all(),'clients' => Clients::all(), 'booking' =>  $booking, 'client' => $client]);
        }        
        else{
            // NU se va schimba camera;
            $booking->roomId = $request->input('specificRoom');
            $booking->save();
            $client->save();
        
            return (['status' => 'updated', 'bookings' =>  Bookings::all(),'clients' => Clients::all(), 'booking' =>  $booking, 'client' => $client]);
        }
    }

    public function updateSpecific($id,$status)
    {
            $booking = Bookings::find($id);
            $booking->Status = $status;
            $booking->save();
            return redirect('/')->with('success','Cazare Actualizata');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
         // if(auth()->user()->name == "admin"){
            
            $booking = Bookings::find($id);
            $client = Clients::find($booking->clientId);
            
            $booking -> delete();
            DB::update("SET @count = 0");
            DB::update("UPDATE `bookings` SET `bookings`.`bookingId` = @count:= @count + 1");
            DB::update("ALTER TABLE `bookings` AUTO_INCREMENT = 1");

            DB::update("SET @count = 0");
            DB::update("UPDATE `clients` SET `clients`.`clientId` = @count:= @count + 1");
            DB::update("ALTER TABLE `clients` AUTO_INCREMENT = 1");

            return (['status' => 'destroyed', 'client' =>  $client]);

            // return (['status' => 'destroyed', 'client' =>  $client , 'booking' =>  $booking, 'bookings' =>  Bookings::all(),'clients' => Clients::all()]);
    }

    public function destroyByClient($clientId)
    {   
        $bookings = Bookings::all();

        foreach($bookings as $booking){
                if($booking->clientId == $clientId){
                    $booking -> delete();
                }
            }

            DB::update("SET @count = 0");
            DB::update("UPDATE `bookings` SET `bookings`.`bookingId` = @count:= @count + 1");
            DB::update("ALTER TABLE `bookings` AUTO_INCREMENT = 1");

            DB::update("SET @count = 0");
            DB::update("UPDATE `clients` SET `clients`.`clientId` = @count:= @count + 1");
            DB::update("ALTER TABLE `clients` AUTO_INCREMENT = 1");
            
            // return (['status' => 'destroyed', 'client' =>  $client , 'booking' =>  $booking, 'bookings' =>  Bookings::all(),'clients' => Clients::all()]);

            return (['status' => 'destroyed','deleteForClient' => $clientId]);
            
    }

     public function check(Request $request)
    {   
        if($request->toCheck=="uniqueInterval"){
            $bookings = Bookings::all();

            foreach($bookings as $booking){
                if(($booking->roomId == $request->roomId)&&($booking->bookingId != $request->bookingId)){
                    if($this->DateRangesOverlap($request->checkin,$request->checkout,$booking->Checkin,$booking->Checkout))
                        return (['roomAvailable' => false]);
                        
                }
            }
            return (['roomAvailable' => true]);
        }
        
        if($request->toCheck=="uniquePhone"){
            // echo "Phone to check: ".$request->phone;
            $clients = Clients::all();
            
            foreach($clients as $client)
                if(($client->clientId != $request->input('clientId'))&&($client->Phone == $request->input('phone')))
                    return (['uniquePhone' => false]);
            
            return (['uniquePhone' => true]);
        }
    }

    public function DateRangesOverlap($start1, $end1, $start2, $end2){
            $start1 = \DateTime::createFromFormat('d/m/Y', $start1);
            $end1 = \DateTime::createFromFormat('d/m/Y', $end1);
            
            $start2 = \DateTime::createFromFormat('d/m/Y', $start2);
            $end2 = \DateTime::createFromFormat('d/m/Y', $end2);

            if(($start1 < $end2)&&($end1 > $start2))return true;
            else return false;
    }

// Gett all the Bookings
     public function get_all(){
        return (['status' => 'success','bookings' => Bookings::all()]);
    }

// Gett the Bookings from a page
     public function by_page(Request $request,$id){
        $status=false;

        $bookings = Bookings::all();
        $bookingsbyPage=array();
        foreach($bookings as $booking)
            if(($booking->bookingId > (($id - 1) * 5))&&($booking->bookingId <= $id*5)){
                    array_push($bookingsbyPage,$booking);
                    // return (['roomAvailable' => false]);
            }
        if(count($bookingsbyPage))$status=true;
        return (['status' => $status ,'page' => $id, 'bookingsbyPage' => $bookingsbyPage]);  
     }

     // Get the Bookings from a date
     public function by_date(Request $request,$date){
        $date = str_replace('-', '/', $date);
        $date = \DateTime::createFromFormat('d/m/Y', $date);

        $bookings = Bookings::all();
        $bookingsbyDate=array();

        foreach($bookings as $booking){
            $Checkin  = \DateTime::createFromFormat('d/m/Y', $booking->Checkin);
            $Checkout = \DateTime::createFromFormat('d/m/Y', $booking->Checkout);
            if(($Checkin <= $date)&&($Checkout >$date)){
                // echo "booking".$booking;
                array_push($bookingsbyDate,$booking);
                    // return (['roomAvailable' => false]);
            }
        }

        return (['status' => "success",'date' => $date,'bookingsbyDate' => $bookingsbyDate]);  
    }

     // Get the Bookings for a client
     public function by_client(Request $request,$clientId){
        $bookings = Bookings::all();
        $bookingsbyClient=array();
        foreach($bookings as $booking)
            if($booking->clientId == $clientId){
                    array_push($bookingsbyClient,$booking);
            }
        return (['status' => "success" , 'bookingsbyClient' => $bookingsbyClient]); 
     }
}
 
