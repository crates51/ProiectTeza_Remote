@extends('layouts.app')

@section('content_outOfContainer_1')
        	<div id="app">
        		<Subheader 
        		title="Contact" 
        		subtitle="contactați-ne"
        		desc=""></Subheader>
        	</div>
@endsection

@section('content')
      
        <div class="jumbotron text-center">
	        	<h1>{{$title}}</h1>
	        	<p>Aceasta este pagina unde ve-ti gasii informatii despre noi</p>
	        	@guest
	        		{{-- <p> --}}
	        		   {{-- <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> --}}
	        		   {{-- <a class="btn btn-success btn-lg" href="/register" role="button">Register</a> --}}
	        		{{-- </p> --}}
	        	@endguest
      </div>
@endsection

