<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralInfo;
use App\Rooms;
use App\Clients;
use App\Bookings;
use Illuminate\Support\Facades\DB;


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

      public function settings()
    {
        $data = [
                'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
                'title'                 => "Settings",
                'addingRooms'           => False
        ];
        return view('pages.setting')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $GeneralInfo = new GeneralInfo;
        $booking = new Bookings;// AM nevoie pentru a gasi clientul ce este cazat in camera ce o vom sterge

        $currentInfo = $GeneralInfo->orderby('created_at', 'desc')->first();

        $previousTotalRooms=$currentInfo->totalRooms;
        $currentInfo->name = $request->input('accommodationName');
        $currentInfo->update();
        $currentInfo->totalRooms = $request->input('totalRooms');
        $TotalroomsTobeRemoved=$previousTotalRooms-$currentInfo->totalRooms;// Am nevoie de valoare asta pentru a afisa cate camere au fost sterse
        $listOfBussyroomsTobeRemoved = array();//Aici se vor adauaga toate camerele ce nu au fost sterse din cauza ca sunt ocupate
        $message="";
        $allRemovedRoomsEmpty=true;

            // Balancing the number of rooms
            if($currentInfo->totalRooms > $previousTotalRooms){
                // ==========Case of Adding Rooms==========
                $data = [
                    'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
                    'title'                 => "Setari",
                    'addingRooms'           => True,
                    'previousTotalRooms'    => $previousTotalRooms,
                    // Creem o noua variabila 'currentTotalRooms' pentru ca "currentGeneralInfo" nu este cea actuala 
                    'currentTotalRooms'    => $currentInfo->totalRooms
                ];

                return view('pages.setting')->with('data',$data);
            }
            else if($currentInfo->totalRooms < $previousTotalRooms){
                // ==========Case of Removing Rooms==========
                // Se verifica mai intai daca toate camere propuse pentru stergere sunt goale
                for ($i=$currentInfo->totalRooms+1; $i <= $previousTotalRooms; $i++) {
                    if(Rooms::find($i)->available==0){
                        $listOfBussyroomsTobeRemoved[]=$i;
                        $allRemovedRoomsEmpty=false;
                    }
                }
                // Daca toate camerele propuse pentru stergere sunt goale le vom sterge 
                if($allRemovedRoomsEmpty){
                    for ($i=$currentInfo->totalRooms+1; $i <= $previousTotalRooms; $i++) { 
                        // echo "Room ".Rooms::find($i)->roomId." has been removed";
                        Rooms::find($i)->delete();
                        // echo nl2br ("\n");
                    }
                    $currentInfo->totalFloors = DB::table('rooms')->max('floorId');
                    $currentInfo->save();
                    if($TotalroomsTobeRemoved>1){
                        return redirect('/')->with('success','Setari Actualizate, au fost scoase <b>'.$TotalroomsTobeRemoved."</b> camere <br>".
                                                             'Numarul curent de camere: '.Rooms::orderby('created_at', 'desc')->count());
                    }
                    else{
                        return redirect('/')->with('success','Setari Actualizate, a fost scoasa <b>'.$TotalroomsTobeRemoved."</b> camera <br>".
                                                   'Numarul curent de camere: '.Rooms::orderby('created_at', 'desc')->count());
                    }
                }
                 else{
                    foreach($listOfBussyroomsTobeRemoved as $bussyRoomTobeRemoved) {
                        $specificBooking = $booking->where("roomId",$bussyRoomTobeRemoved)->get();
                        $specificClient = Clients::find($specificBooking[0]->clientId);
                        $message=$message."Camera ".$bussyRoomTobeRemoved." este ocupata, ".$specificClient->Last_Name." ".$specificClient->First_Name." este cazat/a acolo <br>"; 
                    }
                     return redirect('/')->with('error','Din pacate nu toate camerele propuse pentru stergere sunt goale :(<br>'.$message);
                 }
            }
            else{
                $currentInfo->save();
                return redirect('/');
            }
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
