@extends('layouts.app')

@section('content')
	<h1>Postări</h1>
	@if(count($posts) > 0)
		@foreach($posts as $post)
			<div class="card p-3 mb-3">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
					</div>
					<div class="col-md-8 col-sm-8">
						<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
						<small>Scris pe data de {{$post->created_at}} de catre {{$post->user->name}}</small>
						{{-- 
							-Nu merge User Name... cand ma uit la un post de la un user la care nu sunt logat
							-Presupun ca era un post bug-uit caruia nu ii putea lua numele
						--}}
					</div>
				</div>
			</div>
		@endforeach
		{{$posts->links()}}
	@else
		<p>No posts found</p>
	@endif
@endsection