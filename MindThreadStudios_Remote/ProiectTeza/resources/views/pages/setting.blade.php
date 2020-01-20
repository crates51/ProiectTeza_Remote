@extends('layouts.app')

@section('content')
	@if($data["addingRooms"])
        @include('inc.addRoomsForm')
	@endif

	<div class="row ">
		<div class="col-4 col-md-4 offset-4 mt-4 text-center mb-5">
			<div id="titleBackground">
				<span id="title">{{$data['title']}}</span>
			</div>
		</div>
	</div>

	@include('inc.editGeneralInfoForm')

@endsection