								          	{{-- tac=text align center(costum class) --}}
@extends('layouts.app')

@section('content')

 <app
	:bookings="{{$data['allBookings']}}"
	:rooms="{{$data['rooms']}}"
	:clients="{{$data['clients']}}"
	:is_auth="{{$data['is_auth']}}"
	:totalfloors="{{$data['currentGeneralInfo']->totalFloors}}"
 />

@endsection