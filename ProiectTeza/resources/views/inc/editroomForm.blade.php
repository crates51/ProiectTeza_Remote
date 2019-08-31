	<div class="contact_form_holder" id="app">
	{!! Form::open(['action' => ['RoomsController@update','3'],'id' => 'RoomformContainer','method' => 'POST','enctype'=>'multipart/form-data']) !!}
		<div class="row">
			{{-- Edit Floor Id --}}
			<div class="col-md-4 offset-2">
				<div class="form-group">
                    {{Form::label('floorId', 'Id etaj',['class'=>"text-center"])}}
                    {{Form::number('floorId','1',['id'=>'room_editFloor_input','class' =>'form-control tac','placeholder' => 'Etajul','min' => 0])}}
				</div>	
			</div>
			{{--Edit NrOfBeds --}}
			<div class="col-md-4">
				<div class="form-group">
                    {{Form::label('numberOfBeds', 'Numarul de paturi',['class'=>"text-center"])}}
                    {{Form::number('numberOfBeds','1',['id'=>'room_editNumberOfBeds_input','class' =>'form-control tac','placeholder' => 'Numarul de paturi','min' => 1, 'max' =>10])}}
				</div>	
			</div>
		</div>
		{{--Edit seaSight --}}
		<div class="row">
			<div class="col-md-4 offset-4">
				<div class="form-group">
	                    <div class="row">
	                    	<div class="col-md-6 offset-3">
		                 	   {{Form::label('seaSight', 'Vedere la mare',['class'=>"text-center"])}}
	                    	</div>
	                    </div>
	                    <div class="row">
    	                	<div class="col-md-6 offset-3 tac">
	    	                	{{Form::checkbox('seaSight','1',FALSE,['id'=>'room_editseaSight_input'])}}
    	                	</div>
						</div>
				</div>	
			</div>
		</div>
		 <div class="row">
			<div class="col-md-2 offset-5">
				 {{Form::hidden('_method','PUT')}}
	 	 		 {{Form::submit('Submit',['class'=>'btn btn-dark' , 'id' =>'wrapper'])}}
			</div> 	
		 </div>
		
	{!! Form::close() !!}
	</div>	