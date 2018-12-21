<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Happy Hours</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>

<body>

<!-- Navigation Bar--> <!-- Header -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
<div class="container-fluid">
	<a class="navbar-brand" href="/"><img src="/images/mainLogo.png"></a>
	@if(Route::has('login'))
	    <div class="top-right">
            <a class="signup-btn btn-primary tracker btn" href="/login">Login</a>
            <a class="signup-btn btn-primary tracker btn" href="/register">Register</a>
  	@endif	
                
</div>	
</nav>

<!--- Welcome Section -->
<div class="container-fluid">
<div class="row welcome text-center">
	<div class="col-12">
		<h1 class="display-4">Hey Outlet!!! Are you really running slow ?</h1>
	</div>
</div>
</div>

<!---Register Section -->
<section class="ready-to-start">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="inner-heading-wrapper text-center">
					<h2><span>Ready to get started? </span>Start your growth journey today.</h2>
					<div class="">
					@if(Auth::check())	
					<a href="{{url('/home')}}" class="btn btn-secondary login-js tracker">Register for free</a>
					@else
					<a href="{{url('/register')}}" class="btn btn-secondary login-js tracker">Register for free</a>
					@endif
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Add Listing Section -->
<section class="ready-to-start">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="titile-block text-center">
                        <h2>Reach Millions of People</h2>
                        <p>Add your business infront of millions and earn 3x profits from our tool</p>
   
                    <div class="">
                        <a href="{{url('/addListing')}}" class="btn btn-secondary ">Add your Listing →</a>
                        <p>All it takes is a few minutes with our fast &amp; simple onboarding process</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

<!--- Footer -->

</body>
</html>
