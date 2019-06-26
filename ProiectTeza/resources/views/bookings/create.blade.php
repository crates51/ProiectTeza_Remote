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
<div class="row">
    <div class="col-md-8">    
        <div class="contact_form_holder">
        {!! Form::open(['action' => 'BookingsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
            <div class="row">

            {{--     <div class="col-md-4">
                  <div class="form-group">
                    {{ Form::text('date', '', array('id' => 'datepicker')) }}
                  </div>
                </div> --}}

                <div class="col-md-4">
                    <div class="form-group">
                        {{Form::text('prenume','',['class' =>'form-control','placeholder' => 'Prenume'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{Form::text('nume_Familie','',['class' =>'form-control','placeholder' => 'Nume de Familie'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{Form::text('email','',['class' =>'form-control','placeholder' => 'Adresă de Email'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    {{Form::select('room_type',
                         array('neintrodus' => 'Alegeți Camera',
                               'Cameră Standard' => 'Cameră Standard',
                               'Cameră Terasă' => 'Cameră Terasă',
                               'Apartament' => 'Apartament'),
                               'neintrodus',['class' =>'form-control'])
                    }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    {{Form::select('children_number',
                         array('neintrodus' => 'Copii',
                               '1' => '1',
                               '2' => '2',
                               '3' => '3',
                               '4' => '4',
                               '5' => '5',
                               '>5' => '>5'
                           ),
                         'neintrodus',['class' =>'form-control'])
                    }}
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="form-group">
                    {{Form::select('adults_number',
                         array('neintrodus' => 'Adulți',
                               '1' => '1',
                               '2' => '2',
                               '3' => '3',
                               '4' => '4',
                               '5' => '5',
                               '>5' => '>5'
                           ),
                         'neintrodus',['class' =>'form-control'])
                    }}
                    </div>
                </div>
  
                <div class="col-md-12">
                    {{Form::textarea('message','',['class' =>'form-control mb-3','placeholder' => 'Aveti un mesaj'])}}
                    {{Form::submit('Trimite',['class'=>'btn btn-custom'])}}
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

