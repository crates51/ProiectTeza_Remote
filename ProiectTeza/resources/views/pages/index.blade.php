								          	{{-- tac=text align center(costum class) --}}
@extends('layouts.app')

@section('content')

	{{-- <div id="app"> --}}
		<div class="row ">
			<div class="col-4 col-md-4 offset-4 mt-4 text-center mb-5">
				<div id="titleBackground">
					<a href="addclientModal" data-toggle="modal" data-target="#addclientModal" id="title">{{$data['title']}}</a>
				</div>
			</div>
		</div>
		{{-- <instantsearch></instantsearch> --}}
		<div class="row ">
			<div class="col-4 col-md-4 offset-4 mt-2  text-center mb-5">
				<div id="countBBackground">
					<span id="countB">{{$data['totalBookings']}}</span>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class=" col-md-2 offset-3 text-center mb-5">
				<div class="rectangleShape">
					<a href="{{route('generalinfoController-cookie', 'rooms')}}" class="insideShapeText">{{__("keywords.rooms")}}</a>
				</div>
			</div>
			<div class=" col-md-2 text-center mb-5">
				<div class="rectangleShape">
					<a href="{{route('generalinfoController-cookie', 'bookings')}}" class="insideShapeText">{{__("keywords.bookings")}}</a>
				</div>
			</div>
			<div class=" col-md-2 text-center mb-5">
				<div class="rectangleShape">
					<a href="{{route('generalinfoController-cookie', 'clients')}}" class="insideShapeText">{{__("keywords.clients")}}</a>
				</div>
			</div>
		</div>
<?php
		$responsedCookie = \Cookie::get('currentListDisplayed');
?>
	{{-- </div>	 --}}
	
{{-- <h1>{{ __('<messages class="welcome"></messages>') }}</h1> --}}

{{-- <div class="row"> --}}
	{{-- <span>{{$data['maximumRooms']}}</span> --}}
{{-- </div> --}}
{{-- <div class="row"> --}}
	{{-- <span>The nearest Check-In is in: {{$data['mostRecentCheckin']}}</span> --}}
{{-- </div> --}}

{{-- </script> --}}

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editbookingModal">
  Launch demo modal
</button> --}}


<!--------------------------------Modals-------------------------------->
<!-- ---------------NEW CLIENT MODAL--------------- -->
<div class="modal fade" id="addclientModal" tabindex="-1" role="dialog" aria-labelledby="addclientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addclientModalLabel">New Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  		<div class="container-fluid">
        	@include('inc.newbookingForm')
  		</div>
      </div>
    </div>
  </div>
</div>

<!-- ---------------EDIT Bookings MODAL--------------- -->
<div class="modal fade" id="editbookingModal" tabindex="-1" role="dialog" aria-labelledby="editbookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editbookingModalLabel">Edit Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  		<div class="container-fluid">
        	@include('inc.editbookingForm')
  		</div>
      </div>
    </div>
  </div>
</div>

<!-- ---------------EDIT Rooms MODAL--------------- -->
<div class="modal fade" id="editroomsModal" tabindex="-1" role="dialog" aria-labelledby="editroomsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editroomsModalLabel">Editare Camera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  		<div class="container-fluid">
        	@include('inc.editroomForm')
  		</div>
      </div>
    </div>
  </div>
</div>

<div class="row">
	<div class="mb-4 col-md-4 offset-4 tac floorIdTitle">
		<i class="far fa-calendar-alt fa-lg"></i>
		<span>
			{{$data['today']->day}} {{$data['current_month']}}
		</span>
	</div>
</div>
									
@if($responsedCookie == "rooms" )
{{-- {{$data['today']->format('jS \\of F')}} --}}
<br><span>Show List of Rooms</span>
	@if(count($data['rooms']) > 0)
		@for($i = 0; $i <= $data['currentGeneralInfo']->totalFloors; $i++)
			<div class="row">
				<div class="col-md-4 offset-4 text-center mb-2">
					@if($i==0)
						<span class="floorIdTitle">{{__("keywords.groundfloor")}}</span>
					@else
						<span class="floorIdTitle">{{__("keywords.floor")}} {{$i}}</span>
					@endif
				</div>
			</div>
		
			<div class="row">
			@foreach($data['rooms'] as $room)
				{{-- {{$room->floorId==$i}} --}}
				@if($room->floorId==$i)
				{{-- Daca camera este disponibila --}}
					@if($room->available == 1 )
						<div class="card col-md-4 py-3 mb-5 roomsList">
							<div class="row">
								<div class="col-md-4 offset-4 text-center">
									{{__("keywords.room")}}: {{$room->roomId}}
								</div>
								<div class="col-md-4 text-right">
									<a  data-target="#editroomsModal"
										href="#"
		    							data-toggle="modal"
		  								data-room="{{ $room }}">
										<i class="fas fa-wrench fa-sm"></i>
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 offset-4 text-center Status">
									{{__("keywords.available")}}
								</div> 
							</div>
						</div>
					@elseif($room->available == 0 )
						<div class="card col-md-4 py-3 mb-5 roomsList">
							<div class="row">
								<div class="col-md-4 offset-4 text-center">
									{{__("keywords.room")}}: {{$room->roomId}}
								</div>
								<div class="col-md-4 text-right">
									<a  data-target="#editroomsModal"
										href="#"
		    							data-toggle="modal"
		  								data-room="{{ $room }}">
										<i class="fas fa-wrench fa-sm"></i>
									</a>
									<?php
										global $roomId;
										$roomId = $room->roomId;
										$specificBooking = $data['allBookings']->first(function($item) {
											global $roomId;
										    return $item->roomId == $roomId;
										});

										$specificClient=$data['clients'][$specificBooking->clientId-1];
										echo "<a 
											data-target  ='#editbookingModal'
											data-toggle  ='modal'
											data-booking ='$specificBooking'
											data-client  ='$specificClient'
										>
											<i class='fas fa-user-cog fa-sm'></i>
										</a>
										<clientdeletemodal class='ml-1' isbutton='false' icon_type='fas fa-user-minus fa-sm' booking_id='$specificBooking->bookingId'></clientdeletemodal>	
										";	 

									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 offset-3 text-center Status">
									 
									 <?php 
									 	global $roomId;
										$roomId = $room->roomId;
										$specificBooking = $data['allBookings']->first(function($item) {
											global $roomId;
										    return $item->roomId == $roomId;

										});
										$specificClient=$data['clients'][$specificBooking->clientId-1];
		//Aic se va afisa informatiile Suplimentare cand dai hover pe Nume--PopUp
										echo "
											<div style='display:none' id='BookingInfoTooltip_$specificBooking->bookingId' class='mb-2 mt-2 BookingInfoTooltip'>
												".$specificClient->Last_Name." ".$specificClient->First_Name."<br>
												<i class='fas fa-phone mr-1 mt-3'></i>".$specificClient->Phone."<br>
												<i class='fas fa-envelope mr-1'></i>".$specificClient->Email."<br>
												<i class='fas fa-male fa-lg mr-1'></i>".$specificBooking->Adults."<i class='fas fa-child fa-lg mr-1 ml-4'></i>".$specificBooking->Children."<br>".
												$specificBooking->Checkin." <i class='mx-3 fas fa-angle-double-right mt-3'></i>$specificBooking->Checkout
											</div>
										";

										echo "<span 
											data-booking='$specificBooking'
		  									data-client ='$specificClient'
											id='roomCardclientName_$specificBooking->bookingId'>".
											$specificClient->Last_Name." ".$specificClient->First_Name.
										"</span>";
									 ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 offset-4 text-center Status">
									{{__("keywords.busy")}}
								</div> 
							</div>
						</div>
					@endif			
				@endif
			@endforeach
			</div>
			<br>	
		@endfor
	@else
		<div class="tac">
			<p class="h1">Momentan nu exista camere</p>
			<i class="far fa-frown fa-10x"></i>
		</div>
	@endif
@elseif($responsedCookie == "clients" )

<span>Show List of Clients</span>

@elseif(count($data['bookings']) > 0)
		@foreach($data['bookings'] as $booking)
			<div class="card pt-3 pr-3 pl-3 mb-5 bookingList">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="row">
							<div class="col text-center subtitlesDatalist">
								{{__("keywords.name")}}	
							</div>
						</div>
						<div class="row">
							<div class="col text-center">
								@foreach($data['clients'] as $client)
										@if($booking->clientId == $client->clientId)
											<span> {{$client->Last_Name}} {{$client->First_Name}}</span>
											@break
										@endif
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="row">
							<div class="col text-center subtitlesDatalist">
								{{__("keywords.contact")}}	
							</div>
						</div>
						<div class="row">
							<div class="col text-center">
								@foreach($data['clients'] as $client)
										@if($booking->clientId == $client->clientId)
											<span> {{__("keywords.phone")}}: {{$client->Phone}}</span>
											@break
										@endif
								@endforeach
							</div>	
						</div>
						<div class="row">
							<div class="col text-center">
								@foreach($data['clients'] as $client)
									@if($booking->clientId == $client->clientId)
										<span> {{__("keywords.email")}}: {{$client->Email}}</span>
										@break
									@endif
								@endforeach
							</div>	
						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 ">
						<div class="row">
								<div class="col text-center subtitlesDatalist">
								{{__("keywords.rooms")}}	
								</div>
						</div>
						{{-- <div class="row">
							<div class="col text-center">
									{{__("keyphrases.total_rooms_booked")}}:  <span class="font-weight-bold">{{$booking->totalRooms}}</span> 
							</div>
						</div> --}}
						<div class="row">
							<div class="col text-center">
									{{__("keyphrases.roomId")}}:  <span class="font-weight-bold">{{$booking->roomId}}</span> 
							</div>
						</div>
						<div class="row">
							<div class="col text-center">
								@if($booking->Adults == 1)
									There will be <span class="font-weight-bold">{{$booking->Adults}}</span> Adult
									@if($booking->Children == 1)
										and <span class="font-weight-bold">{{$booking->Children}}</span> child 
									@else
										and <span class="font-weight-bold">{{$booking->Children}}</span> children 
									@endif		  
								@else
									There will be <span class="font-weight-bold">{{$booking->Adults}}</span> Adults 
									@if($booking->Children == 1)
										and <span class="font-weight-bold">{{$booking->Children}}</span> child 
									@else
										and <span class="font-weight-bold">{{$booking->Children}}</span> children 
									@endif
								@endif
							</div>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="row pt-3 pl-3 pr-3 mt-5">
							<div class="col text-center subtitlesDatalist">
								Status
							</div>
						</div>
						<div class="row">
							<div class="col text-center ">
								{{-- Client asked for booking but not yet accepted --}}
								@if($booking->Status == "Pending")

									{{-- <div class="mybutton">reference</div> --}}

									<div style="display:none" id="CancelTooltip_{{$booking->bookingId}}" class="mb-2 mt-2 CancelTooltip">
										<span> Decline The Booking</span>
									</div>

									<div style="display:none" id="AcceptTooltip_{{$booking->bookingId}}" class="mb-2 mt-2 AcceptTooltip">
										<span> Accept The Booking</span>
									</div>

								{{-- 	<a href="/bookings/{{$booking->id}}/update/Canceled">
										<i id="cancelAnchor_{{$booking->id}}" class="fas fa-ban fa-lg pr-3 cancelAnchor" 		   style="color:tomato"></i>
									</a> --}}
									<clientstatusmodal popuptype="error" message="Declined" status='Cancel' booking_id={{$booking->bookingId}}></clientstatusmodal>
									

									<span style="color: #FFAA00FF" >{{$booking->Status}}</span>
									
									<clientstatusmodal popuptype="success" message="Accepted" status='Accept' booking_id={{$booking->bookingId}}></clientstatusmodal>

									{{-- <a href="/bookings/{{$booking->bookingId}}/update/Booked">
										<i id="AcceptAnchor_{{$booking->bookingId}}" class="far fa-check-circle fa-lg pl-3 AcceptAnchor"  style="color:green"></i>
									</a> --}}								
								{{-- Client asked for booking, has been accepted --}}
								@elseif($booking->Status == "During the stay")
									<span class="text-success"> {{$booking->Status}}</span>

								@elseif($booking->Status == "Booked")
									<span class="text-success"> {{$booking->Status}}</span>

								{{-- Client asked for booking, we canceled it --}}
								@elseif($booking->Status == "Canceled")
									<span class="text-danger"> {{$booking->Status}}</span>

								{{-- Client was booked, finished and left --}}

								@elseif($booking->Status == "Finished")
									<span class="text-primary">{{$booking->Status}}</span>
								@endif	

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card p-3 mt-5">
								<div class="row">
									<div class="col-md-6 text-center">Check-In</div>
									<div class="col-md-6 text-center">Check-Out</div>
								</div>
								<div class="row">
									<div class="col-md-6 text-center">{{$booking->Checkin}}</div>
									<div class="col-md-6 text-center">{{$booking->Checkout}}</div>
								</div>
						</div>	
					</div>
					<div class="col-md-4 align-self-end">
						<div class="row">
							<div class="col-md-4">
								@auth
									<a class="btn btn-warning openEditModal"
										{{-- class="openEditModal"  --}}
									 	{{-- href="{{route('bookings.edit', $booking->bookingId)}}" --}}
  										href="#"
    									data-target="#editbookingModal"
    									data-toggle="modal"
  									 	data-booking="{{ $booking }}"
  									 	data-client="{{ $data['clients'][$booking->clientId-1] }}"
  									 	{{-- {{ $data['clients'][4-1]->First_Name }} --}}

									  >
										<i class="fas fa-pencil-alt"></i>
									</a>
								@endauth
							</div>
							<div class="col-md-4 tac">
								<a class="btn btn-dark" href="{{route('bookings-show', $booking->bookingId)}}" >
									<i class="fas fa-sign-in-alt"></i>
								</a>
							</div>
							<div class="col-md-4">
								@auth
									{{-- <a class="btn btn-danger float-right" onclick="return confirm('Are you sure?')" href="{{route('bookings-destroy', $booking->bookingId)}}"> --}}
										{{-- <i class="fa fa-trash"></i> --}}
									{{-- </a> --}}
									<clientdeletemodal isbutton="true" icon_type="fa fa-trash" booking_id={{$booking->bookingId}}></clientdeletemodal>
								@endauth
							</div>
						</div>
						{{-- @auth
								{!!Form::open(['action'=> ['BookingsController@destroy', $booking->bookingId],'method'=>'POST','class' => 'float-right'])!!}
									{{Form::hidden('_method','DELETE')}}
									{{Form::submit('Delete',['class' => 'btn btn-danger'])}}
								{!! Form::close() !!
}						@endauth
		}
		}
 --}}

					</div>
				</div>
				<div class="row">
					<div class="col-md-4 offset-4 text-center pt-3" id="clientId">
						<span>
							{{$booking->bookingId}}
						</span>
					</div>
				</div>
			</div>
		@endforeach
		{{$data['bookings']->links()}}
	@else
	<div class="tac">
		<p class="h1">Momentan nu exista cazari</p>
		<i class="far fa-frown fa-10x"></i>
	</div>
	@endif
@endsection