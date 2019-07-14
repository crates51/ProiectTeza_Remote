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
			<div class="col-4 col-md-4 offset-4 mt-4  text-center mb-5">
				<div id="countBBackground">
					<span id="countB">{{$data['totalBookings']}}</span>
				</div>
			</div>
		</div>



	{{-- </div>	 --}}
	
{{-- <h1>{{ __('<messages class="welcome"></messages>') }}</h1> --}}

{{-- <div class="row"> --}}
	{{-- <span>{{$data['maximumRooms']}}</span> --}}
{{-- </div> --}}
{{-- <div class="row"> --}}
	{{-- <span>The nearest Check-In is in: {{$data['mostRecentCheckin']}}</span> --}}
{{-- </div> --}}

{{-- </script> --}}

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editclientModal">
  Launch demo modal
</button> --}}


<!-- ---------------Modals--------------- -->

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
        	@include('inc.newclientForm')
  		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editclientModal" tabindex="-1" role="dialog" aria-labelledby="editclientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editclientModalLabel">Edit Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  		<div class="container-fluid">
        	{{-- @include('inc.editclientForm') --}}
        {{-- 	@foreach($data['bookings'] as $booking)
				<span>{{$booking->Status}}</span>
        	@endforeach --}}
        	@include('inc.editclientForm')
        	{{-- {{ --}}
        		{{-- $data['bookings'][0]->Status	 --}}
        	{{-- }} --}}
  		</div>
      </div>
    </div>
  </div>
</div>

<!-- ------------------------------------ -->
{{-- <span>Experiment: {{ $data['bookings'][0]->bookingId }}</span> --}}
{{-- <span>Experiment: {{ $data['clients'][4-1]->First_Name }}</span> --}}

{{-- $data['clients'] --}}
@if(count($data['bookings']) > 0)
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
										class="openEditModal" 
									 	{{-- href="{{route('bookings.edit', $booking->bookingId)}}" --}}
  										href="#"
    									data-target="#editclientModal"
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
									<clientdeletemodal booking_id={{$booking->bookingId}}></clientdeletemodal>
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
		<p class="h1">There are no bookings, yet</p>
		<i class="far fa-frown fa-10x"></i>
	</div>


	@endif
@endsection