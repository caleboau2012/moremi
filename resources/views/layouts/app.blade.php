<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Cheeks">
	<meta name="author" content="Moree.me">
	<meta name="keywords" content="Moree.me">
	<meta property="fb:app_id" content="469144689836682" />
	<link rel="icon" type="image/x-icon" href="{{ asset("images/favicon.ico") }}">
	<title>Moree.me</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
	{{--<link href="https://fonts.googleapis.com/css?family=Raleway|Kalam" rel="stylesheet">--}}
	<link href="https://fonts.googleapis.com/css?family=Droid+Sans|Muli|Noto+Sans|PT+Sans|PT+Sans+Narrow|Poppins|Titillium+Web" rel="stylesheet">
	<link href="{{ asset('libs/bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
	<link href="{{ asset('icomoon/style.css') }}" rel="stylesheet" >

	<link href="{{ asset('css/master.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/util.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/media.css') }}" rel="stylesheet" >
	<link href="{{ asset('libs/sweetalert/sweetalert.css') }}" rel="stylesheet" >

	@yield('stylesheets')

</head>
<body id="app-body">

@section('header')
@show

@yield('content')

 @section('footer')
    @include('include.footer')
 @show

@section('bottomScripts')
	{{-- Libs --}}
	<script src="{{asset('libs/jquery/jquery.min.js')}}" ></script>
	<script src="{{asset('libs/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('libs/sweetalert/sweetalert.min.js')}}" ></script>

	<!--Custom Javascript-->
	<script src="{{asset('js/app/Utils.js')}}" ></script>
	<script src="{{asset('js/app/Constants.js')}}" ></script>
	<script src="{{asset('js/app/Routes.js')}}" ></script>

	<!--FacebookScript-->
	<script src="{{asset('js/app/Facebook.js')}}"></script>

	<script src="{{asset('js/app/Profile.js')}}" ></script>
	<script src="{{ asset('js/app/moment.js') }}"></script>
	<script>
        $('.format_time').each(function (e) {
            var val = $(this).text();
            var date = moment(new Date(val));
            $(this).text(date.fromNow());
        });
	</script>

	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/592f51ce4374a471e7c50d55/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
@show
</body>

</html>
