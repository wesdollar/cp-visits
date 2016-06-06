<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Visit App by MTM &amp; CallingPost</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ url('css/marketing.css') }}" rel="stylesheet">

    <!-- Javascript -->

</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Visit App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/marketing-landing') }}">Home</a></li>
                @if (Auth::user())
                    <li><a href="{{ url('/visitees') }}">Visitees</a></li>
                    <li><a href="{{ url('/groups') }}">Groups</a></li>
                @endif
                <li><a href="{{ url('/marketing-landing#about') }}">About</a></li>
                <li><a href="{{ url('/help') }}">Help</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

@yield('content')

<div class="alt-content">

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <p>
                    Visit is provided free of charge by Move the Mountain in partnership with CallingPost Communications. Move the Mountain was founded with the goal of helping churches grow by providing software-based solutions to help streamline church operations.
                </p>
                <p>
                    CallingPost Communications has been providing churches and other civic organizations group communication tools since 1995. Their experience and expertise in helping organizations communicate with their members has enabled many different types of organizations to grow thanks to the tools provided by the CallingPost software.
                </p>
                <p>
                    Move the Mountain is a 501c-3 non-profit organization.
                </p>
            </div>
            <div class="col-md-3 center">
                <p>
                    <a href="http://www.mtm123.org" target="_blank">
                        <img src="{{ asset('img/logo-mtm.png') }}" alt="Move the Mountain Ministries">
                    </a>
                </p>
                <p>
                    <a href="http://www.callingpost.com" target="_blank">
                        <img src="{{ asset('img/logo-cp.png') }}" alt="CallingPost Communications">
                    </a>
                </p>
            </div>
        </div>
    </div>

</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="center small-font">
                    &copy; {{ date('Y') }} Move the Mountain &amp; CallingPost Communications. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>

</body>
</html>
