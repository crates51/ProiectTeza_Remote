<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Bookings;
use App\Clients;
use App\GeneralInfo;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data = [
            'bookings'              => Bookings::orderBy('bookingId','asc')->paginate(5),
            'totalBookings'         => Bookings::orderBy('created_at','desc')->count(),
            'maximumRooms'          => Bookings::max('totalRooms'),
            'mostRecentCheckin'     => Bookings::max('Checkin'),
            'clients'               => Clients::all(),
            'totalClients'          => Clients::orderBy('created_at','desc')->count(),
            'currentGeneralInfo'    => GeneralInfo::orderby('created_at', 'desc')->first(),
            'currentDate'           => date("Y-m-d"),
            'title'                 => __("keyphrases.new_client")
        ];

        return view('auth.register')->with('data',$data);;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
