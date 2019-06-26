@extends('layouts.app')

@section('content_outOfContainer_1')
        	<div id="app">
        		<Subheader 
        		title="Galerie" 
        		subtitle=""
        		desc=""></Subheader>
        	</div>
@endsection

@section('content')

    <div class="text-center" id="app">
    	<h1>{{$title}}</h1>
    	{{-- <p>Aceasta este pagina cu poze</p> --}}
    	{{-- <p>Si aici sunt pozele</p> --}}
    	<Gallery></Gallery>
    </div>
@endsection

















	        	{{-- @guest
	        		<p>
	        		   <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
	        		   <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
	        		</p>
	        	@endguest --}}
