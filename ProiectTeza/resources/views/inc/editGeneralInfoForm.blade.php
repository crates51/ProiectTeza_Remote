	<div class="contact_form_holder" id="app">
	{!! Form::open(['action' => ['generalinfoController@update','null'],'id' => 'formContainer','method' => 'POST','enctype'=>'multipart/form-data']) !!}
	{{-- Edit Accomodation Name --}}
		<div class="row">
			<div class="col-md-4 mt-5 offset-2">
				<div class="form-group">
					{{Form::label('accommodationName', 'Name')}}
					{{Form::text('accommodationName',$data['currentGeneralInfo']->name ,['class' =>'form-control tac','placeholder' => 'Name' ])}}
				</div>	
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-md-4 mt-5 offset-2">
				<div class="form-group">
					{{Form::label('totalRooms', __("keyphrases.number_of_rooms"))}}
					{{Form::text('totalRooms',$data['currentGeneralInfo']->totalRooms ,['class' =>'form-control tac','placeholder' => 'Number of Rooms' ])}}
				</div>	
			</div>
		</div> --}}
		 <div class="row">
			<div class="col-md-2 offset-5">
				 {{Form::hidden('_method','PUT')}}
	 	 		 {{Form::submit('Submit',['class'=>'btn btn-dark' , 'id' =>'wrapper'])}}
			</div> 	
		 </div>
		
	{!! Form::close() !!}
	</div>	