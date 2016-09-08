<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/sticky-footer-navbar.css') }}">

    <style>

        .footer {
            color: #000;
            background-color: #fff;
        }

        .footer .footer-title {
            font-weight: 400;
        }

        .footer a {
            color: #000;
            background-color: #fff;
        }

        .footer a:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .footer .footer-main .footer-main-col {
            padding: 0;
            border-top: 1px solid #777;
        }

        .footer .footer-main ul {
            list-style-type: none;
            padding: 20px 0;
        }

        .footer .footer-main li {
            margin-bottom: 5px;
        }

        .footer .footer-main p {
            margin-bottom: 5px;
        }

        .footer .footer-main i {
            font-size: 25px;
            margin-right: 5px;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
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
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
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
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row footer-main">
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li><span class="footer-title">© 2016 GetHype</span></li>
                        <li><a>About GetHype</a></li>
                        <li><a>Blog</a></li>
                        <li><a>Help</a></li>
                        <li><a>Careers</a></li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li><span class="footer-title">Celine</span></li>
                        <li><a>Buy a gift</a></li>
                        <li><a>Arrange a surprise</a></li>
                        <li><a>Contact us</a></li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li><span class="footer-title">Language</span></li>
                        <li><a>Indonesia</a></li>
                        <li><a>English</a></li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li>
                            <p class="footer-title">Download us</p>
                            <a><i class="fa fa-android"></i></a>
                            <a><i class="fa fa-apple"></i></a>
                        </li>
                        <li>
                            <p class="footer-title">Follow us</p>
                            <a><i class="fa fa-facebook-official"></i></a>
                            <a><i class="fa fa-twitter"></i></a>
                            <a><i class="fa fa-instagram"></i></a>
                            <a><i class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
