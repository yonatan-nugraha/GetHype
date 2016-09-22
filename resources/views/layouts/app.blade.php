<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gethype') }}</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/sticky-footer-navbar.css') }}">

    <style>
        @media (min-width: 1200px) {
            .container {
                width: 1080px;
            }
        }

        /**************************************/
        /************** Header ****************/
        /**************************************/

        .navbar-default {
            background-color: #0F3844;
            border: none;
            font-weight: normal;
            letter-spacing: 2px;
            font-weight: 300;
            margin-bottom: 0;
            height: 85px;
        }

        .navbar-default .navbar-brand {
            color: #fff;
        }

        .navbar-default .navbar-nav>li>a {
            color: #fff;
        }

        .navbar-default .navbar-brand img {
            width: 60px;
        }

        .navbar-default .nav-bar-right {
            vertical-align: text-top;
        }

        .navbar-nav > li > a {
           line-height: 55px;
           font-size: 14px;
        }

        .navbar-right li > ul {
           border-radius: 0 !important;
        }

        .navbar-right li > ul > li > a {
           font-size: 14px;
           font-weight: 300;
           letter-spacing: 0;
        }

        .user-image img {
            max-width: 40px;
        }

        /**************************************/
        /************** Footer ****************/
        /**************************************/

        .footer {
            color: #fff;
            background-color: #0F3844;
            font-size: 17px;
        }

        .footer .gethype-logo {
            width: 100px;
        }

        .footer .footer-title {
            margin-bottom: 20px !important;
            font-weight: 500;
        }

        .footer a {
            color: #fff;
            font-weight: 100;
        }

        .footer a:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .footer .footer-main {
            margin-top: 30px;
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

        .footer .gethype-logo {
            width: 120px;
        }

        .footer .gethype-copyright {
            text-align: center;
            margin-top: 20px;
            font-weight: 100;
        }

        .gethype-line {
            width: 100%;
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
                    <img src="{{ asset('images/logo.png') }}">
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
                                <span>{{ Auth::user()->first_name }}</span>
                                @if (Auth::user()->last_name)
                                <span> {{ Auth::user()->last_name }}</span>
                                @endif
                                <span class="user-image">
                                    <img src="{{ asset('/images/users/user-1.png') }}">
                                </span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/tickets') }}">My Tickets</a>
                                </li>
                                <li>
                                    <a href="{{ url('/account/settings') }}">Account Settings</a>
                                </li>
                                <li class="divider"></li>
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
                    <img class="gethype-logo" src="{{ asset('images/logo.png') }}">
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li class="footer-title">Gethype</li>
                        <li><a>Home</a></li>
                        <li><a>About Us</a></li>
                        <li><a>Partners</a></li>
                        <li><a>Journals</a></li>
                        <li><a>Careers</a></li>
                        <li><a>Terms</a></li>
                        <li><a>Support</a></li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li class="footer-title">Service</li>
                        <li><a>Advertising</a></li>
                        <li><a>Consultation</a></li>
                        <li><a>Planner</a></li>
                        <li><a>Ticketing</a></li>
                        <li><a>Social Media</a></li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-main-col">
                    <ul>
                        <li class="footer-title">Get in Touch</li>
                        <li><a>Customer Support</a></li>
                        <li><a>Contact Us</a></li>
                        <li><a>Instagram</a></li>
                        <li><a>Facebook</a></li>
                        <li><a>Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="row footer-secondary">
                <img class="gethype-line" src="{{ asset('images/img-additional-2.png') }}">
                <p class="gethype-copyright">2016 | Gethype.co.id</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/event.js"></script>
</body>
</html>
