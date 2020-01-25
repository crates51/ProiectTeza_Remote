<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralInfo;
use App\Rooms;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo "rooms index";
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
     *1
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $currentTotalRooms)
    {   

        // echo "Previous Total Rooms: ".Rooms::orderby('created_at', 'desc')->count();
        // echo "Current Total Rooms: ".$currentTotalRooms;

        // Resetez Indexul la camere pentru a-l insera pe cel corect
        DB::update("SET @count = 0");
        DB::update("UPDATE `rooms` SET `rooms`.`roomId` = @count:= @count + 1");
        DB::update("ALTER TABLE `rooms` AUTO_INCREMENT = 1");

        // echo "nr of rooms".$nrOfRoomsToAdd;
        // TREBUIE DE FACUT: De moficat pentru stagiul INITIAL "Let's prepare de rooms"
        $roomTobeAdded=$currentTotalRooms-Rooms::orderby('created_at', 'desc')->count();// Am nevoie de valoare asta pentru a afisa cate camere au fost adugate

        for ($i=Rooms::orderby('created_at', 'desc')->count()+1; $i <= $currentTotalRooms; $i++) { 

            $Room = new Rooms;

            // $Room->floorId = $request->input('nrOfBeds_'.$i);
            $Room->nrOfBeds = $request->input('numberOfBeds_'.$i);
            $Room->floorId = $request->input('floorId_'.$i);
            echo "Room on floor: ".$request->input('floorId_'.$i); 
            echo nl2br ("\n");

            if($request->input('seaSight_'.$i) == NULL)$Room->seaSight = false;
            else $Room->seaSight = $request->input('seaSight_'.$i);
            
            // if($Room->available = $request->input('available_'.$i) == NULL)$Room->available = false;
            // else $Room->available = $request->input('available_'.$i);

            $Room->save();
        }
        
        $GeneralInfo = new GeneralInfo;
        $currentInfo = GeneralInfo::orderby('created_at', 'desc')->first();

        $GeneralInfo->name = $currentInfo->name;
        $GeneralInfo->totalRooms = Rooms::orderby('created_at', 'desc')->count();
        $GeneralInfo->totalFloors = DB::table('rooms')->max('floorId');
        $GeneralInfo->totalRoomsSet = $currentInfo->totalRoomsSet;
        $GeneralInfo->allRoomsPrepared = true;
        $GeneralInfo->save();

        // return redirect('/')->with('success','Congrats, general info updated, Stage 2/2, Finished :)');
        // return redirect('/')->with('success','Setari Actualizate, au fost adaugate ');
     
        if($roomTobeAdded>1){
            return redirect('/')->with('success','Setari Actualizate, au fost adaugate <b>'.$roomTobeAdded."</b> camere <br>".
                                                 'Numarul curent de camere: '.Rooms::orderby('created_at', 'desc')->count());
        }
        else{
            return redirect('/')->with('success','Setari Actualizate, a fost adaugata <b>'.$roomTobeAdded."</b> camera <br>".
                                                 'Numarul curent de camere: '.Rooms::orderby('created_at', 'desc')->count());
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
            'floorId' => 'required',
            'nrOfBeds' => 'digits_between:1,10',
            // 'seaSight' => 'required',
        ]);

       
       
        // $room = Bookings::find($roomId);
        $room = Rooms::find($id);
        
      

        if(!$request->input('seaSight'))$room->seaSight = false;
        else $room->seaSight = $request->input('seaSight');

        $room->floorId = $request->input('floorId');
        $room->nrOfBeds = $request->input('nrOfBeds');
    

        // echo $room;
        $room->save();

        $GeneralInfo = new GeneralInfo;
        // $currentInfo = $GeneralInfo->orderby('created_at', 'desc')->first();
        $currentInfo = GeneralInfo::orderby('created_at', 'desc')->first();

        $GeneralInfo->name = $currentInfo->name;
        $GeneralInfo->totalRooms = Rooms::orderby('created_at', 'desc')->count();
        $GeneralInfo->totalFloors = DB::table('rooms')->max('floorId');
        $GeneralInfo->totalRoomsSet = $currentInfo->totalRoomsSet;
        $GeneralInfo->allRoomsPrepared = $currentInfo->allRoomsPrepared;

        $GeneralInfo->save();

        return (['status' => 'updated']);

        // return redirect('/')->with('success','Booking Updated');
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
