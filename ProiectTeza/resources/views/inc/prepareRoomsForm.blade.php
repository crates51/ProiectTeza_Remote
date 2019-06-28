	<div class="modal fade" id="prepareRoomsModal" tabindex="-1" role="dialog" aria-labelledby="prepareRoomsModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  		  <div class="modal-content">
  		    <div class="modal-header">
  		      <h5 class="modal-title" id="prepareRoomsModalLabel">Let's prepare the rooms</h5>
  		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  		        <span aria-hidden="true">&times;</span>
  		      </button>
  		    </div>
  		    <div class="modal-body">
            </span>
      {!! Form::open(['action' => 'RoomsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
            {{-- {{$data['currentGeneralInfo']->totalRooms}} --}}
            @for ($i = 1; $i <= $data['currentGeneralInfo']->totalRooms; $i++)
            {{-- @foreach($data['rooms'] as $room) --}}
            {{--  --}}
              <div class="card pt-3 pr-3 pl-3 mb-5 bookingList">
              <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group tac">
                    {{Form::label('available', 'Room '.$i,['class'=>"text-center"])}}
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-4">
                  <div class="form-group tac">
                    {{Form::label('available_'.$i, 'Available',['class'=>"text-center"])}}
                    <br>
                    {{Form::checkbox('available_'.$i,'1',TRUE)}}
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group tac">
                     {{Form::label('seaSight_'.$i, 'Has Sea Sight',['class'=>"text-center"])}}
                    <br>
                    {{Form::checkbox('seaSight_'.$i,'1',FALSE)}}
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group tac">
                    {{Form::number('numberOfBeds_'.$i,'',['class' =>'form-control tac','placeholder' => 'Number of beds'])}}
                  </div>
                </div>
              </div>
              </div>
              @endfor
              {{--  --}}
            {{-- @endforeach --}}
            {{-- {{ $data['rooms']->links()}} --}}
              <div class="row">
                <div class="col-md-2 offset-5">
                  {{Form::submit('Trimite',['class'=>'btn btn-dark', 'id' =>'wrapper'])}}
                </div>
              </div>
      {!! Form::close() !!}
        </div>
  		  </div>
  		</div>
	</div>