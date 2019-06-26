@extends('layouts.app')

@section('content_outOfContainer_1')
    <div id="app">
    	<Subheader 
    	title="Cazare" 
    	subtitle="FaceȚi rezervare"
    	desc=""></Subheader>
    </div>
@endsection


@section('content')
<div class="row align-center">
    <div class="col-md-8">
    	<h1 class>Creare Postare</h1>
        {!! Form::open(['action' => 'BookingsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Titlu')}}
                {{Form::text('title','',['class' =>'form-control','placeholder' => 'Titlu'])}}
            </div>
{{--             <div class="form-group">
                {{Form::label('body','Corp')}}
                {{Form::textarea('body','',['id' => 'article-ckeditor', 'class' =>'form-control','placeholder' => 'Body Text'])}}
            </div>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>   --}}
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
</div>
@endsection

