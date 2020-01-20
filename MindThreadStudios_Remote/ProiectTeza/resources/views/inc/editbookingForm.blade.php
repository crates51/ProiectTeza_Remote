	<div class="contact_form_holder" id="app">
	{!! Form::open(['action' => ['BookingsController@update','3'],'id' => 'BookingformContainer','method' => 'POST','enctype'=>'multipart/form-data']) !!}
	{{-- Edit Full Name --}}
		<div class="row">
			<div class="col-md-4 offset-2">
				<div class="form-group">
					{{Form::text('firstName',"",['id' => 'booking_editFirstName_Form','class' =>'form-control tac','placeholder' => 'First Name' ])}}
				</div>	
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::text('lastName',"",['id' => 'booking_editLastName_Form','class' =>'form-control tac','placeholder' => 'Last Name'])}}
				</div>	
			</div>
		</div>
		{{--Edit Contact --}}
		<div class="row">
			<div class="col-md-4 offset-2">
				<div class="form-group">
					{{Form::text('email',"",['id'=>'booking_editEmail_input','class' =>'form-control tac','placeholder' => 'Email'])}}
				</div>	
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::text('phone',"",['id'=>'booking_editPhone_input','class' =>'form-control tac','placeholder' => 'Phone'])}}
				</div>	
			</div>
		</div>
		{{-- Edit The Rooms --}}
		<div class="row">
	        <div class="col-md-4 offset-2">
	          <div class="form-group">
	            {{Form::select('adults_number',
	                 array("" => "",
	                       '1' => '1',
	                       '2' => '2',
	                       '3' => '3',
	                       '4' => '4',
	                       '5' => '5',
	                       '>5' => '>5',
                           ' ' => 'Adults'

	                   ),
	                 'neintrodus',['id'=>'booking_editAdults_input','class' =>'form-control '])
	            }}
	          </div>
	        </div>
	    {{--     <div class="col-md-4 ">
            	<div class="form-group">
            	   {{Form::number('totalRooms',"",['id'=>'editTotalRooms_input','class' =>'form-control tac','placeholder' => 'Total Rooms'])}}
            	</div>
        	</div> --}}
            <div class="col-md-4">
                <div class="form-group">
                {{Form::select('children_number',
                     array("" => "",
                           '1' => '1',
                           '2' => '2',
                           '3' => '3',
                           '4' => '4',
                           '5' => '5',
                           '>5' => '>5',
                           ' ' => 'Children'
                       ),
                     'neintrodus',['id'=>'booking_editChildren_input','class' =>'form-control'])
                }}
                </div>
            </div>
      </div>
      {{-- Edit Checks --}}
       <div class="row">
        <div class="col-md-3 offset-3 mb-3">
               <div class="input-group date"  data-provide="datepicker">
                  {!! Form::text('Check-in',"", ['id'=>'booking_editCheckIn_input','class' => 'form-control tac', 'value' =>'03-11-2020', 'autocomplete' => 'off' ,'placeholder' => 'Check-in'] ) !!}
                   <div class="input-group-addon">
                       <span class="glyphicon glyphicon-th" ></span>
                   </div>
               </div>
        </div>  
        <div class="col-md-3  mb-3">
               <div class="input-group date" data-provide="datepicker">
                  {!! Form::text('Check-out',"", ['id'=>'booking_editCheckOut_input','class' => 'form-control tac' , 'autocomplete' => 'off' , 'placeholder' => 'Check-out'] ) !!}
                   <div class="input-group-addon">
                       <span class="glyphicon glyphicon-th" ></span>
                   </div>
               </div>
        </div>
      </div>
      {{-- Edit Status --}}
      <div class="row">
        <div class="col-md-4 offset-4">
	          <div class="form-group">
	            {{Form::select('status',
	                 array("" => "",
	                       'During the stay' => 'During the stay',
	                       'Booked' => 'Booked',
	                       'Finished' => 'Finished',
	                       'Pending' => 'Pending',
	                       'Canceled' => 'Canceled',
                           ' ' => 'Status'
	                   ),
	                 'neintrodus',['id'=>'booking_editStatus_input','class' =>'form-control '])
	            }}
	          </div>
	    </div>
      </div>
      <div class="row">
      	<div class="col-md-4 offset-4" >
	        <div class="form-group">
	          {{Form::number('specificRoom','',['class' =>'form-control tac','id' =>'booking_specificRoomInput','min' => 1,'max' => $data['currentGeneralInfo']->totalRooms,'placeholder' => 'Specific Room'])}}
	        </div>
      	</div>
      </div>
		{{-- <div class="form-group">
			{{Form::label('body','Body')}}
			{{Form::textarea('body',$post->body,['id' => 'article-ckeditor', 'class' =>'form-control','placeholder' => 'Body Text'])}}
		</div>
		 --}}
		 <div class="row">
			<div class="col-md-2 offset-5">
				 {{Form::hidden('_method','PUT')}}
	 	 		 {{Form::submit('Submit',['class'=>'btn btn-dark wrapper'])}}
			</div> 	
		 </div>
		
	{!! Form::close() !!}
	</div>	