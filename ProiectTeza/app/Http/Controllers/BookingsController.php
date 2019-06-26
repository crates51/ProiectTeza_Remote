<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Booking;

class BookingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bookings = Booking::orderBy('created_at','desc')->paginate(10);
 
        // return view('bookings.index')->with('bookings',$bookings);
        return view('bookings.create');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
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
            'nume_Familie' => 'required',
            'email' => 'required',
            'adults_number' => 'required',
            'children_number' => 'required',
            'room_type' => 'required',
        ]);

        $booking = new Booking;
        $booking->First_Name = $request->input('prenume');
        $booking->Last_Name = $request->input('nume_Familie');
        $booking->Email = $request->input('email');
        $booking->Adults = $request->input('adults_number');
        $booking->Children = $request->input('children_number');
        $booking->Rooms = $request->input('room_type');
        $booking->Message = $request->input('message');

        // $post->body = $request->input('body');
        // $post->user_id = auth()->user()->id;
        // $post->cover_image = $fileNameToStore;
        $booking->save();

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
