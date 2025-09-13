<!--Author: W3layouts Author URL: http://w3layouts.com License: Creative Commons Attribution 3.0 Unported License URL: http://creativecommons.org/licenses/by/3.0/-->
<!DOCTYPE html>
<html>
<head>

<title>Corsa Racer a Gaming Category Flat Bootstrap Responsive Website Template | :: W3layouts</title>

<!-- For-Mobile-Apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Corsa Racer a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps -->

<!-- Custom-Stylesheet-Links -->
	<!-- Bootstrap-Core-CSS --> <link rel="stylesheet" href="template/css/bootstrap.min.css" type="text/css" media="all"/>
	<!-- Index-Page-Styling --> <link rel="stylesheet" href="template/css/style.css" type="text/css" media="all" />
	<!-- Owl-Carousel-CSS --> <link rel="stylesheet" href="template/css/owl.carousel.css" type="text/css" media="all"/>
	<!-- Popup-Box-CSS --> <link rel="stylesheet" href="template/css/popuo-box.css" type="text/css" media="all"/>
<!-- //Custom-Stylesheet-Links -->

<!-- Web-Fonts -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Racing+Sans+One' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<!-- //Web-Fonts -->

</head>
<body>

	<!-- Header -->
	<div class="header">

		<!-- Navbar -->
		<nav class="navbar navbar-default navbar-fixed">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Cambiar navegación</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Cars Liberty</a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="hover-effect"><a href="#">{{ __('actions.home') }}</a></li>
						<li class="hover-effect"><a href="#about">{{ __('actions.about') }}</a></li>
						{{-- <li class="hover-effect"><a href="#features">{{ __('Features') }}</a></li>
						<li class="hover-effect"><a href="#skills">{{ __('Skills') }}</a></li>
						<li class="hover-effect"><a href="#team">{{ __('Team') }}</a></li>
						<li class="hover-effect"><a href="#download">{{ __('Download') }}</a></li> 
						<li class="hover-effect"><a href="#contact">{{ __('Contact') }}</a></li>--}}
						<li class="hover-effect"><a href="{{ url("login")}}">{{ __('actions.login') }}</a></li>
					</ul>
				</div>

			</div>
		</nav>
		<!-- //Navbar -->

		<!-- Slider -->
	 	@include('template.slider')
		<!-- //Slider -->

	</div>
	<!-- //Header -->

	<!-- About -->
	 	@include('template.about')
	<!-- //About -->

	<!-- Features -->
	{{-- @include('template.features') --}}
	<!-- //Features -->

	<!-- Real -->
	{{-- @include('template.real') --}}

	<!-- //Real -->

	<!-- New -->
	{{-- @include('template.new') --}}
	<!-- //New -->

	<!-- Formats -->
	{{-- @include('template.formats') --}}
	<!-- //Formats -->

	<!-- Progressive-Effects -->
	{{-- @include('template.progressive-effects') --}}
	<!-- Progressive-Effects -->

	<!-- Team -->
	{{-- @include('template.team') --}}
	<!-- //Team -->
	
	<!-- Download -->
	{{-- @include('template.download') --}}

	<!-- //Download -->

	<!-- Map-iFrame -->
	<div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.7311611414207!2d-76.55994502373747!3d3.415556487686575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e30a41b5db4bd23%3A0x95a1a161104c94c6!2sCl.%201%20Oe.%20%2352-112%2C%20Belisario%20Caicedo%2C%20Cali%2C%20Valle%20del%20Cauca!5e0!3m2!1sen!2sco!4v1757708874529!5m2!1sen!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
	<!-- //Map-iFrame -->

	<!-- Contact -->
	{{-- @include('template.contact') --}}
	<!-- //Contact -->

	<!-- Footer -->
 		@include('template.footer')
	<!-- //Footer -->

	<!-- Custom-JavaScript-File-Links -->

	<!-- Supportive-JavaScript --> <script type="text/javascript" src="template/js/jquery.min.js"></script>
	<!-- Necessary-JS-File-For-Bootstrap --> <script type="text/javascript" src="template/js/bootstrap.min.js"></script>

	<!-- Banner-Slider-JavaScript -->
	<script src="template/js/responsiveslides.min.js"></script>
	<script>
		$(function () {
			$("#slider").responsiveSlides({
				auto: true,
				nav: true,
				speed: 800,
				namespace: "callbacks",
				pager: true,
			});
		});
	</script>
	<!-- //Banner-Slider-JavaScript -->

	<!-- Owl-Carousel-JavaScript -->
	<script src="template/js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel ({
				items : 4,
				lazyLoad : true,
				autoPlay : true,
				pagination : false,
			});
		});
	</script>
	<!-- //Owl-Carousel-JavaScript -->

	<!-- Magnific-Popup-Display-JavaScript -->
	<script src="template/js/jquery.magnific-popup.js" type="text/javascript"></script>
	<script>
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
	});
	</script>
	<!-- //Magnific-Popup-Display-JavaScript -->

	<!-- Progressive-Effects-Animation-JavaScript -->
	<script type="text/javascript" src="template/js/jquery.inview.min.js"></script>
	<script type="text/javascript" src="template/js/wow.min.js"></script>
	<script type="text/javascript" src="template/js/mousescroll.js"></script>
	<script type="text/javascript" src="template/js/main.js"></script>
	<script type="text/javascript" src="template/js/numscroller-1.0.js"></script>
	<!-- //Progressive-Effects-Animation-JavaScript -->

	<!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
	<script type="text/javascript">
		$(document).ready(function() {
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 100,
				easingType: 'linear'
			};
			$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
	<!-- //Slide-To-Top JavaScript -->

	<!-- Smooth-Scrolling-JavaScript -->
	<script type="text/javascript" src="template/js/move-top.js"></script>
	<script type="text/javascript" src="template/js/easing.js"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll, .navbar li a, .footer li a").click(function(event){
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
	<!-- //Smooth-Scrolling-JavaScript -->

<!-- //Custom-JavaScript-File-Links -->

</body>
</html>