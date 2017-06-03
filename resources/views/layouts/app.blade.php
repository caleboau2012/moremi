<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="It all starts with a date">
	<meta name="author" content="Moree.me">
	<meta name="keywords" content="Moree.me">
	<meta property="fb:app_id" content="469144689836682" />
	<title>Moree.me</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png')}}" />
	{{--<link href="https://fonts.googleapis.com/css?family=Raleway|Kalam" rel="stylesheet">--}}
	{{--<link href="https://fonts.googleapis.com/css?family=Droid+Sans|Muli|Noto+Sans|PT+Sans|PT+Sans+Narrow|Poppins|Titillium+Web" rel="stylesheet">--}}
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,400italic,600,300italic,300|Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<link href="{{ asset('libs/bootstrap/bootstrap.min.css') }}" rel="stylesheet" >

	<link href="{{ asset('css/tabs.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/tabstyles.css') }}" rel="stylesheet" >
	<link href="{{ asset('icomoon/style.css') }}" rel="stylesheet" >

	<link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{asset('libs/owl/owl.theme.css')}}" rel="stylesheet">
	<link href="{{asset('libs/owl/owl.transitions.css')}}" rel="stylesheet">

	<link href="{{ asset('css/master.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/util.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/media.css') }}" rel="stylesheet" >
	<link href="{{ asset('libs/sweetalert/sweetalert.css') }}" rel="stylesheet" >

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="{{asset('js/html5shiv.min.js') }}"></script>
	<script src="{{asset('js/respond.min.js')}}"></script>
	<![endif]-->
	@yield('stylesheets')

</head>
<body id="app-body" data-target=".main-nav" data-spy="scroll">

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
	<script src="{{ asset('libs/jquery/jquery-easing.js') }}"></script>

	<script src="{{asset('libs/jquery/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.appear.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.nicescroll.min.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.countTo.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.shuffle.modernizr.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.shuffle.js')}}"></script>
	<script src="{{asset('libs/jquery/jquery.ajaxchimp.min.js')}}"></script>

	<script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>
	<script src="{{asset("js/cbpFWTabs.js")}}"></script>

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
