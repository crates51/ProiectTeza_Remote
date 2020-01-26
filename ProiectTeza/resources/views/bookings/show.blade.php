@extends('layouts.app')

@section('content')


<div class="jumbotron mt-2 tac">
{{--   @auth
  <div class="row">
    <div class="col-md-12 align-self-end">
      <div class="float-right"> --}}
        
  {{--       <a href="{{route('bookings-destroy', $booking->bookingId)}}" onclick="return confirm('Are you sure?')">
          <i class="fas fa-trash-alt fa-lg mr-3"></i>
        </a> --}}
        {{-- <clientdeletemodal booking_bookingId={{$booking->bookingId}}></clientdeletemodal> --}}

 {{--        <a href="{{route('bookings.edit', $booking->bookingId)}}">
          <i class="fas fa-pencil-alt fa-lg"></i>
        </a> --}}
        {{-- <a class="btn btn-warning mr-3" href="{{route('bookings.edit', $booking->bookingId)}}" > --}}
              {{-- <i class="fas fa-pencil-alt"></i> --}}
        {{-- </a> --}}
{{--       </div>
    </div>
  </div>
  @endauth --}}
  <h1 class="display-4 ">{{$client->Last_Name}} {{$client->First_Name}}</h1>
  <p class="lead ">
  	{{$booking->Checkin}}
  	<i class="mx-3 fas fa-angle-double-right" ></i>
  	 {{$booking->Checkout}}
  </p>
  
  	@if($booking->Status == "Pending")
		<h3 style="color: #FFAA00FF" >{{$booking->Status}}</h3>
  	@elseif($booking->Status == "Booked")
		<h3 class="text-success"> {{$booking->Status}}</h3>
  	@elseif($booking->Status == "Canceled")
		<h3 class="text-danger"> {{$booking->Status}}</h3>
  	@elseif($booking->Status == "Finished")
		<h3 class="text-primary">{{$booking->Status}}</h3>
	@endif

 

  <hr class="my-4">
  <div class="row">
  	<div class="col-md-12 ">
  		<h1 class="display-4">
  			<small>Rooms</small>
  		</h1>
  		<h1 class="display-4 ">
  			<small>	{{$booking->totalRooms}}</small>
  		</h1>
  	</div>
  </div> 	
  <div class="row ">
  	<div class="col-md-6 ">
  		<i class="fas fa-male fa-5x"></i>
  		<h1 class="display-4 ">
  			<small>	{{$booking->Adults}}</small>
		</h1>
  	</div>
  	<div class="col-md-6 ">
  		<i class="fas fa-child fa-5x"></i>
  		<h1 class="display-4 ">
  			<small>	{{$booking->Children}}</small>
		</h1>
  	</div>
  </div>
  <hr class="my-4">
  <div class="row">
  	<div class="col-md-6">
  		<i class="fas fa-envelope fa-5x"></i>	
  		<h3 class="mt-2">
  			{{$client->Email}}
		</h3>
  	</div>
  	<div class="col-md-6">
  		<i class="fas fa-phone fa-5x"></i>	
  		<h3 class="mt-2">
				{{$client->Phone}}
		  </h3>
  	</div>
  </div>
</div>

@endsection
