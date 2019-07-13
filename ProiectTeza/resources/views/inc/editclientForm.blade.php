	<div class="contact_form_holder" id="app">
	{{-- {!! Form::open(['action' => ['BookingsController@update', "3"],'id' => 'formContainer','method' => 'POST','enctype'=>'multipart/form-data']) !!} --}}

	    {!! Form::open(['action' => ['BookingsController@store'],'id' => 'formContainer','method' => 'POST','enctype'=>'multipart/form-data']) !!}

	{{-- Edit Full Name --}}
		<div class="row">
			<div class="col-md-4 offset-2">
				<div class="form-group">
					{{Form::text('firstName',"",['id' => 'editFirstName_Form','class' =>'form-control tac','placeholder' => 'First Name' ])}}
				</div>	
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::text('lastName',"",['id' => 'editLastName_Form','class' =>'form-control tac','placeholder' => 'Last Name'])}}
				</div>	
			</div>
		</div>
		{{--Edit Contact --}}
		<div class="row">
			<div class="col-md-4 offset-2">
				<div class="form-group">
					{{Form::text('email',"",['id'=>'editEmail_input','class' =>'form-control tac','placeholder' => 'Email'])}}
				</div>	
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{{Form::text('phone',"",['id'=>'editPhone_input','class' =>'form-control tac','placeholder' => 'Phone'])}}
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
	                 'neintrodus',['id'=>'editAdults_input','class' =>'form-control '])
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
                     'neintrodus',['id'=>'editChildren_input','class' =>'form-control'])
                }}
                </div>
            </div>
      </div>
      {{-- Edit Checks --}}
       <div class="row">
        <div class="col-md-3 offset-3 mb-3">
               <div class="input-group date"  data-provide="datepicker">
                  {!! Form::text('Check-in',"", ['id'=>'editCheckIn_input','class' => 'form-control tac', 'value' =>'03-11-2020', 'autocomplete' => 'off' ,'placeholder' => 'Check-in'] ) !!}
                   <div class="input-group-addon">
                       <span class="glyphicon glyphicon-th" ></span>
                   </div>
               </div>
        </div>  
        <div class="col-md-3  mb-3">
               <div class="input-group date" data-provide="datepicker">
                  {!! Form::text('Check-out',"", ['id'=>'editCheckOut_input','class' => 'form-control tac' , 'autocomplete' => 'off' , 'placeholder' => 'Check-out'] ) !!}
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
	                       'Booked' => 'Booked',
	                       'Finished' => 'Finished',
	                       'Pending' => 'Pending',
	                       'Canceled' => 'Canceled',
                           ' ' => 'Status'

	                   ),
	                 'neintrodus',['id'=>'editStatus_input','class' =>'form-control '])
	            }}
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
	 	 		 {{Form::submit('Submit',['class'=>'btn btn-dark' , 'id' =>'wrapper'])}}
			</div> 	
		 </div>
		
	{!! Form::close() !!}
	</div>	