@extends('layouts.app')

@section('content_outOfContainer_1')
        	<div id="app">
        		<Subheader 
        		title="Camere" 
        		subtitle="Moderne si SpaȚioase"
        		desc=""></Subheader>
        	</div>
@endsection

@section('content')
        <div class="jumbotron text-center">
	        	<h1>{{$title}}</h1>
	        	<p>Aceasta este pagina cu camere</p>
      </div>
@endsection

