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

<nav class="navbar navbar-default navbar-static-top visible-sm visible-xs">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Visit App
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::user())
                    <li><a href="{{ url('/visitees') }}">Visitees</a></li>
                    <li><a href="{{ url('/groups') }}">Groups</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
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
        </div>
    </div>
</nav>

<div class="splash-screen">
    <div class="container">

        <div class="row visible-lg visible-md">
            <div class="col-md-6">

                <span class="big-font">Visit App</span>

            </div>
            <div class="col-md-6 text-right" id="nav">

                @if (Auth::guest())
                    <a href="{{ url('/login') }}" class="btn btn-lg btn-primary">Login</a>
                @endif

                @if (Auth::user())
                    <a href="{{ url('/visitees') }}" class="btn btn-lg btn-primary">Visitees</a>
                    <a href="{{ url('/groups') }}" class="btn btn-lg btn-primary">Groups</a>
                @endif

            </div>
        </div>

        <div class="row" id="leader">
            <div class="col-md-8 col-md-offset-2">
                <p class="biggest-font">
                    A visit from a friendly face with a smile has the power to move mountains.
                </p>
                <p class="big-font top-gutter">
                    Visit is an app that allows you to create and share lists of people who could use a friendly visit, such as those that are hospitalized or home-bound.
                </p>

                @include('partials.appStoreButtons')

            </div>
        </div>

    </div>
</div>

<div class="alt-content">
    <div class="container">

        <div class="row icon-row">
            <div class="col-md-4">
                <i class="fa fa-share-alt biggest-font"></i>
                <p class="bigger-font">Easily Share Lists</p>
                <p>
                    After creating a list, anyone that has downloaded the Visit app can search for and request to subscribe to your Visitee list.
                </p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-check-square-o biggest-font"></i>
                <p class="bigger-font">Check-In During Visits</p>
                <p>
                    Users can check-in while visiting a Visitee and add a note or photo that other subscribers to the list will be able to see.
                </p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-list-ul biggest-font"></i>
                <p class="bigger-font">Live Visit Log</p>
                <p>
                    Visit tracks check-ins in real time giving everyone subscribed to your list an up-to-date count of how many times someone has been visited.
                </p>
            </div>
        </div>

    </div>
</div>

<div class="main-content">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-6">
                <p class="center">
                    <img src="{{ asset('img/screen-shots/iphone-visitee-list.png') }}" alt="Visit Visitor Log App by CallingPost">
                </p>
            </div>
            <div class="col-md-6 col-md-pull-6 big-font">
                <p>
                    We created Visit to give churches and other groups a way to create, maintain, and share lists of people who could use a friendly visitor from time to time. It's perfect for ensuring that people who are hospitalized or home-bound  aren't forgotten by the members of the church or organization.
                </p>
                <p>
                    Visit puts an up-to-date list of people to visit right in the pocket of anyone with a smart phone. Each member subscribed to the Visitee list is permitted to add and edit Visitees, which means no one central point of contact is required to maintain the list and ensure its information is up to date. Users are given the ability to check-in once they arrive at the Visitee's location and are provided the ability to record notes about their visit, add a photo, and share their experience with the other members of your group.
                </p>

                @include('partials.appStoreButtons')

            </div>
        </div>
    </div>

</div>

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
