@extends('layouts.app')

@section('content_outOfContainer_1')
        	<div id="app">
        		<Subheader 
        		title="Știri" 
        		subtitle="Ultimele Știri"
        		desc=""></Subheader>
        	</div>
@endsection


@section('content')
        @if(count($news) > 0)
            <ul class="list-group">
                @foreach($news as $new)
                    <li class="list-group-item">{{$new}}</li>
                @endforeach
            </ul>
        @endif
@endsection

