<!DOCTYPE html>
<html lang="en">
<head>

	<title>@yield('title')</title>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Laravel Test" />
	<meta name="author" content="Sanjay Sahu Bandla" />

	<!-- Icon -->
	<link rel="icon" type="image/png" href="/Images/Icon.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/Images/Icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/Images/Icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/Images/Icon.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/Images/Icon.png">

	<link rel="apple-touch-icon" type = "image/png" href="/Images/Icon.png"/>
	
	<!-- fontawesome -->
	<link href="{{ asset('Assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

	<!-- ///Bootstrap/// -->

	<!-- CSS - Bootstrap-->
	<link rel="stylesheet" href="{{ asset('Assets/plugins/bootstrap-4.4.1/dist/css/bootstrap.min.css') }}">

	<!-- JQuery -->
	<script src="{{ asset('Assets/plugins/jquery/jquery-3.4.1.slim.min.js') }}"></script>

	<!-- JS, Popper.js, and jQuery - Bootstrap-->
	<script src="{{ asset('Assets/plugins/bootstrap-4.4.1/dist/js/bootstrap.min.js') }}"></script>

	<!-- Ajax -->

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script> -->

	<!-- Google fonts -->

	<link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=Rancho&display=swap" rel="stylesheet">

	<!-- External CSS & JS -->

	<link rel="stylesheet" type="text/css" href="{{ asset('Assets/dist/style.css') }}">

	<script type="text/javascript" src="{{ asset('Assets/dist/script.js') }}"></script>

	<style type="text/css">

		body {
			font-family: 'Comic Neue', cursive;
			/*font-weight: normal;*/
		}
		
	</style>

</head>

<body class="">

	<!-- top nav -->

	<nav class="navbar navbar-expand-lg navbar-light text-primary justify-content-between shadow mt-0 pt-0" >
		<a class="navbar-brand text-primary" href="#" style="font-size: 25px;">
			<img src="/Images/icon.png" class="rounded-circle" width="35px;">
			<span style="font-family: 'Rancho', cursive; font-style: italic;font-size: 27px;">Food-X</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse flex-grow-0 d-flex justify-content-around d-none d-lg-block" id="navbarSupportedContent" style="font-size: 18px;letter-spacing: 1px;">
			<ul class="navbar-nav mr-auto text-right d-none d-lg-flex">
				<li class="nav-item mr-4 active">
					<a id="d_home" class="nav-link" href="/home">
						<i class="fa fa-home"></i> Home <span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a id="d_restaurent" class="nav-link mr-4" href="/search_restaurent">
						<i class="fas fa-utensils"></i>  Near Restaurents
					</a>
				</li>
				<li class="nav-item">
					<a id="d_cart" class="nav-link mr-4" href="/cart">
						<i class="fa fa-cart-plus"></i> Cart
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-4" href="mailto:sanjaysahubandla@gmail.com?subject=Hey there !">
						<i class="fab fa-telegram-plane"></i> Contact us
					</a>
				</li>
				<li class="nav-item">
					<a id="d_profile" class="nav-link mr-4" href="/profile/{{ $user->id ?? '' }}">
						<i class="fa fa-user"></i> Profile
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<div id="yield_section">
		@yield('content')
	</div>

	<!-- bottom navbar -->
	<div id="navbar">
		<ul class="list-unstyled">
			<li>
				<a href="/home" class="text-muted" id="home"><i class="fa fa-home"></i></a>
			</li>
			<li>
				<a href="/search_restaurent" class="text-muted" id="search_restaurent"><i class="fa fa-search"></i></a>
			</li>
			<li>
				<a href="/cart" class="text-muted" id="cart"><i class="fas fa-shopping-cart"></i></a>
			</li>
			<li>
				<a href="/profile/{{ $user->id ?? '' }}" class="text-muted" id="profile"><i class="fa fa-user"></i></a>
			</li>
		</ul>
	</div>

	<!-- Site footer -->
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h6>About</h6>
					<p class="text-justify">Food-X.com <i>You Buy, We FLY </i> is a food delivery service in India to delivery food to the users from their desired restaurants with delicious food.</p>
				</div>

				<div class="col-xs-6 col-md-3">
					<h6>Categories</h6>
					<ul class="footer-links">
						<li><a href="#">KFC</a></li>
						<li><a href="#">Veg</a></li>
						<li><a href="#">Non Veg</a></li>
						<li><a href="#">Top Pics</a></li>
					</ul>
				</div>

				<div class="col-xs-6 col-md-3">
					<h6>Quick Links</h6>
					<ul class="footer-links">
						<li><a href="#">About Us</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Contribute</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Sitemap</a></li>
					</ul>
				</div>
			</div>
			<hr>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<p class="copyright-text">Copyright &copy; {{ date('Y') }} All Rights Reserved by 
						<a href="#">Food-X</a>.
					</p>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
						<li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>   
					</ul>
				</div>
			</div>
		</div>
	</footer>
	
</body>

</html>