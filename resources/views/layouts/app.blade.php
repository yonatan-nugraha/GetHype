<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('metas')

    <title>{{ config('app.name', 'Gethype') }}</title>

    <!-- Icon -->
    <link rel="icon" href="{{ asset('images/logo_dark.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.6.3/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sticky-footer-navbar.css') }}">
    
    @yield('styles')

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
            color: #f2f2f2;
        }

        .navbar-default .navbar-nav>li>a {
            color: #f2f2f2;
        }

        .navbar-default .navbar-nav>li>a:hover{
            color: #ccc;
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /**************************************/
        /************** Footer ****************/
        /**************************************/

        .footer {
            color: #f2f2f2;
            background-color: #0F3844;
            font-size: 17px;
            display: -webkit-box;
            position: inherit;
        }

        .footer .footer-title {
            margin-bottom: 20px !important;
            font-weight: 500;
        }

        .footer a {
            color: #f2f2f2;
            font-weight: 100;
        }

        .footer a:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .footer .footer-main {
            margin-top: 2.8em;
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
            width: 90px;
        }

        .footer .gethype-copyright {
            text-align: center;
            margin-top: 20px;
            font-weight: 100;
        }

        .gethype-line {
            width: 100%;
            height: 7px;
        }

        .footer-secondary{
            margin-top:5em;
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
                        <li><a href="{{ url('/journals') }}">Journal</a></li>
                        <li><a href="{{ url('/register') }}">Sign up</a></li>
                        <li><a href="{{ url('/login') }}">Log in</a></li>
                    @else
                        @if (count(Auth::user()->events) > 0)
                        <li><a href="{{ url('/myevents') }}">My Events</a></li>
                        @endif

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span>{{ Auth::user()->first_name }}</span>
                                @if (Auth::user()->last_name)
                                <span> {{ Auth::user()->last_name }}</span>
                                @endif
                                <span class="user-image">
                                    <img src="{{ asset('/images/users/'.Auth::user()->photo()) }}">
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
                <div class="col-xs-2 footer-main-col">
                    <ul>
                        <li class="footer-title">Gethype</li>
                        <li><a>About Us</a></li>
                        <li><a>Events</a></li>
                        <li><a>Partners</a></li>
                        <li><a>Services</a></li>
                        <li><a>What we do</a></li>
                        <li><a>Journals</a></li>
                    </ul>
                </div>
                <div class="col-xs-2 footer-main-col">
                    <ul>
                        <li class="footer-title">Get in Touch</li>
                        <li><a>Contact Us</a></li>
                        <li><a>Instagram</a></li>
                        <li><a>Facebook</a></li>
                        <li><a>Twitter</a></li>
                    </ul>
                </div>
                <div class="col-xs-5 footer-main-col" style="padding-top: 2em; font-weight: 100">
                    <p style="font-size: 20px" class="footer-title">JOIN OUR MAILING LIST</p>
                    <span>We promise zero spam and only relevant information on events and what's happening in Gethype</span>

                    <p style="margin-top:2em">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">SUBMIT</span>
                        </div>
                    </p>
                </div>
            </div>
            <div class="row footer-secondary">
                <img class="gethype-line" src="{{ asset('images/img-additional-2.png') }}">
                <p class="gethype-copyright">2016 | Gethype.co.id</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/date.js') }}"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-85188569-1', 'auto');
      ga('send', 'pageview');

    </script>
    
    @yield('scripts')
</body>
</html>
