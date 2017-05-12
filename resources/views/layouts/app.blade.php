<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Cheeks">
	<meta name="author" content="Moree.me">
	<meta name="keywords" content="Moree.me">
	<link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
	<title>Moree.me</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
	{{--<link href="https://fonts.googleapis.com/css?family=Raleway|Kalam" rel="stylesheet">--}}
	<link href="https://fonts.googleapis.com/css?family=Droid+Sans|Muli|Noto+Sans|PT+Sans|PT+Sans+Narrow|Poppins|Titillium+Web" rel="stylesheet">
	<link href="{{ asset('libs/bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
	<link href="{{ asset('icons/style.css') }}" rel="stylesheet" >

	<link href="{{ asset('css/master.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/util.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/media.css') }}" rel="stylesheet" >
	<link href="{{ asset('libs/sweetalert/sweetalert.css') }}" rel="stylesheet" >

	@yield('stylesheets')

</head>
<body id="app-body">

@section('header')
    @include('include.header_app')
@show

@yield('content')

 @section('footer')
    @include('include.footer_min')
 @show

 @section('bottomScripts')
    <script src="{{asset('libs/jquery/jquery.min.js')}}" ></script>
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/vendor/sweetalert.min.js')}}" ></script>
@show
</body>

</html>
