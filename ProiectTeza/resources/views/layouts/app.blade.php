<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>{{ $data['currentGeneralInfo']->name }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="jquery.color.min.js"></script> --}}

    <script async src="https://cse.google.com/cse.js?cx=000868277343143690004:ejxmkhrv4rp"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?fajquermily=Nunito" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Grand+Hotel&display=swap" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    {{-- <link rel="stylesheet" href="{{asset('material-icons/iconfont/material-icons.css')}}"> --}}
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.1.1/themes/algolia-min.css" integrity="sha256-nkldBwBn2NQqRL1mod7BqHsJ6cEOn6u/ln6F/lI4CFo=" crossorigin="anonymous">
    {{-- <li><a href="{{ url('locale/fr') }}" ><i class="fa fa-language"></i> FR</a></li> --}}
</head>
<body>  
 @auth
    <div id="app">
      <div class="gcse-searchbox"></div>
        @include('inc.navbar')
        @include('inc.messages')
          <div class="container">
             @if(!$data['currentGeneralInfo']->totalRoomsSet)
               <generalinfomodal></generalinfomodal>
             @else
               @if(!$data['currentGeneralInfo']->allRoomsPrepared)
                 @include('inc.prepareRoomsForm')
               @else
                 @yield('content')
               @endif
             @endif
          </div>
    </div>
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script>
    $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
    $.fn.datepicker.defaults.autoclose = true;
    //Fac Highlight la weekend
    $.fn.datepicker.defaults.daysOfWeekHighlighted = [0,6];
    $.fn.datepicker.defaults.weekStart = 1;
    // $.fn.datepicker.defaults.title = "Hello";
    $.fn.datepicker.defaults.todayBtn = 'linked';
    // $.fn.datepicker.defaults.startDate= '03/18/2020';

    
  </script>
 @endauth
 
 @guest
  <div class="jumbotron tac">
    <div class="row">
      <div class="col-12">
        <i class="fas fa-lock fa-3x" style="color:tomato"></i>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-4">
        <div class="h1">
          Please Log In first
        </div>    
      </div>
    </div>
  </div>

  @include('inc.loginForm')

 @endguest   

</body>

</html>
