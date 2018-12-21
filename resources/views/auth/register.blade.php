<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>


    <title>Happy Hours</title>
</head>

<body>

    <!-- Navigation Bar--> <!-- Header -->
<nav class="navbar navbar-expand-md navbar-light ">
<div class="container-fluid">
    <a href="/"><center><img src="/images/mainLogoBig.png"></center></a>
</div>  
</nav>

<section>
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="titile-block text-center">
                         <h2>If your outlet is not listed, get it done today</h2> 
                         <div class="">
                            <a href="{{url('/addListing')}}" class="btn btn-primary ">Add your Listing →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               <div class="panel-heading">
                    <div><h1>Register</h1></div>
                    <div style="text-align: right; vertical-align: middle;">
                        <a href="{{url('/login')}}">Login</a>
                    </div>
                </div> 
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('merchant_id') ? ' has-error' : '' }}">
                            <label for="merchant_id" class="col-md-4 control-label">Merchant ID</label>

                            <div class="col-md-6">
                                <input id="merchant_id" type="text" class="form-control" name="merchant_id" required>

                                @if ($errors->has('merchant_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('merchant_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                           <div class="form-group{{ $errors->has('owner_key') ? ' has-error' : '' }}">
                            <label for="owner_key" class="col-md-4 control-label">Owner Key</label>

                            <div class="col-md-6">
                                <input id="owner_key" type="text" class="form-control" name="owner_key" required>

                                @if ($errors->has('owner_key'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                    <!--    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>