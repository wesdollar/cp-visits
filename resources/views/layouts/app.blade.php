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
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/sweetalert.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="{{ url('js/sweetalert.min.js') }}"></script>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
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
                    Visits
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::user())
                        <li><a href="{{ url('/visitees') }}">Visitees</a></li>
                        <li><a href="{{ url('/groups') }}">Lists</a></li>
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

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/sweetalert.min.js') }}"></script>
    <script src="{{ url('js/sweetalert.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @if (session('success'))
        <script>
            swal({
                title: "Success!",
                text: "{{ session('success') }} <br><br><small><em>To close, click close, click anywhere outside of alert box, press esc key, or wait 3 seconds.</small></em>",
                html: true,
                type: "success",
                confirmButtonText: "Close",
                allowOutsideClick: true,
                allowEscapeKey: true,
                timer: 3000
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {

            $('#addEmail').click(function(e) {
                e.preventDefault();
                $('#extraEmails').append('<br><input type="text" class="form-control" id="form-name" name="email[]" placeholder="email address">');
            });

        });
    </script>

</body>
</html>
