<div class="contact_form_holder" id="app">
	    {!! Form::open(['action' => 'BookingsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
		<div class="row">
    	{{-- Names --}}
  	    <div class="col-md-4 offset-2">
		          <div class="form-group">
		                {{Form::text('nume','',['class' =>'form-control tac','placeholder' => 'Nume'])}}
			   	  </div>
		    </div>
		    <div class="col-md-4">
		         <div class="form-group">
		                {{Form::text('prenume','',['class' =>'form-control tac','placeholder' => 'Prenume'])}}
		         </div>
			</div>
    </div>
    {{-- Contact --}}
    <div class="row">
        <div class="col-md-4 offset-2">
             <div class="form-group">
                    {{Form::email('email','',['class' =>'form-control tac','placeholder' => 'Email'])}}
             </div>
        </div>
			  <div class="col-md-4">
             <div class="form-group">
                    {{Form::text('phone','',['class' =>'form-control tac','placeholder' => 'Phone'])}}
             </div>
        </div>
    </div>
    {{-- Total People --}}
    <div class="row">
        <div class="col-md-4 offset-2">
          <div class="form-group">
            {{Form::select('adults_number',
                 array('' => 'Adults',
                       '1' => '1',
                       '2' => '2',
                       '3' => '3',
                       '4' => '4',
                       '5' => '5',
                       '>5' => '>5'
                   ),
                 'neintrodus',['class' =>'form-control '])
            }}
          </div>
        </div>
          <div class="col-md-4">
              <div class="form-group">
              {{Form::select('children_number',
                   array('' => 'Children',
                         '0' => '0',
                         '1' => '1',
                         '2' => '2',
                         '3' => '3',
                         '4' => '4',
                         '5' => '5',
                         '>5' => '>5'
                     ),
                   'neintrodus',['class' =>'form-control'])
              }}
              </div>
          </div>
      </div>
          {{-- Checkin Checkout --}}
    <div class="row">
      <div class="col-md-3 offset-3">
             <div class="input-group date form-group" data-provide="datepicker">
                {!! Form::text('Check-in', null, ['class' => 'form-control tac','autocomplete' => 'off', 'placeholder' => 'Check-in'] ) !!}
                 <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th" ></span>
                 </div>
             </div>
      </div>  
      <div class="col-md-3">
             <div class="input-group date form-group" data-provide="datepicker">
                {!! Form::text('Check-out', null, ['id' => 'editFirstName_Form','class' => 'form-control tac' , 'autocomplete' => 'off' , 'placeholder' => 'Check-out'] ) !!}
                 <div class="input-group-addon">
                     <span class="glyphicon glyphicon-th" ></span>
                 </div>
             </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 offset-3">
          <div class="form-group">
            <span>Find room automatic</span>
            {{Form::radio('automatic','1',false,['class' =>'tac','id' => 'findAutomaticRadio'])}}
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
            {{Form::radio('automatic','1',true,['class' =>'tac','id' => 'findManualRadio'])}}
            <span>Find room Manual</span>
          </div>
      </div>
    </div>
    {{-- The maximum rooms a client can book is the total rooms number in accomodation  --}}
    {{-- I Have to make it: total free rooms number in accomodation --}}
    <div class="row">
    {{--   <div class="col-md-4 offset-2">
          <div class="form-group">
             {{Form::number('totalRooms','',['class' =>'form-control tac','id' =>'totalRoomsInput','min' => 1,'max' => $data['currentGeneralInfo']->totalRooms,'placeholder' => 'Total Rooms'])}}
          </div>
      </div> --}}
      <div class="col-md-4 offset-4" >
        <div class="form-group">
          {{Form::number('specificRoom','',['class' =>'form-control tac','id' =>'specificRoomInput','min' => 1,'max' => $data['currentGeneralInfo']->totalRooms,'placeholder' => 'Specific Room'])}}
        </div>
      </div>
      <div class="col-md-4 offset-4" style="display: none;">
        <div class="form-group">
        {{Form::number('nrOfBeds','',['class' =>'form-control tac','id' =>'nrOfBedsInput','min' => 1,'max' => 5,'placeholder' => 'Total Beds'])}}
        </div>
      </div>
    </div>
    {{-- test --}}
    {{-- <div id="specificInsert">
      <div class="row">
        <div class="col-md-4 offset-4" >
          <div class="form-group">
            {{Form::number('specificRoom','',['class' =>'form-control tac','id' =>'specificRoomInput','min' => 1,'max' => $data['currentGeneralInfo']->totalRooms,'placeholder' => 'Specific Room'])}}
          </div>
        </div>
      </div>  
    </div> --}}
    {{-- test --}}
    <div class="row">
      <div class="col-md-2 offset-5" style="display: none;">
        <div class="form-group">
          {{Form::label('seaSight', 'Sea Sight',['class'=>"text-center mr-2"])}}
          {{Form::checkbox('seaSight','1',false,['class' =>'tac','id' =>'seaSightInput'])}}
        </div>
      </div>
    </div>
		<div class="row">
			<div class="col-md-2 offset-5">
				{{Form::submit('Trimite',['class'=>'btn btn-dark', 'id' =>'wrapper'])}}
			</div>
		</div>
	    {!! Form::close() !!}
	</div>	



        {{-- Room Type --}}
      {{-- <div class="row">
        <div class="col-md-4 offset-4">
            <div class="form-group">
              {{Form::select('room_type',
                   array('' => 'Alegeți Camera',
                         'Cameră Standard' => 'Cameră Standard',
                         'Cameră Terasă' => 'Cameră Terasă',
                         'Apartament' => 'Apartament'),
                         'neintrodus',['class' =>'form-control'])
              }}
            </div>
        </div>
      </div> --}}
         {{-- Total Rooms --}}