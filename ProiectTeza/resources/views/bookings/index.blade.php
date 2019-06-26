
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
    <button type="button" class="btn btn-block btn-success mb-5">Creeaza Cazare</button>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
            <div class="card p-3 mb-3">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/bookings/{{$booking->id}}">{{$booking->First_Name}}</a></h3>
                        {{-- <small>Scris pe data de {{$booking->created_at}} de catre {{$booking->user->name}}</small> --}}
                        
                    </div>
                </div>
            </div>
        @endforeach
        {{$bookings->links()}}
    @else
        <h3 class="text-center">Nu s-au gasit cazari </h3>
    @endif
@endsection

