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
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/main.css') }}">
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
                <div class="col-sm-3 footer-main-col">
                    <img class="gethype-logo" src="{{ asset('images/logo.png') }}">
                </div>
                <div class="col-sm-2 footer-main-col">
                    <ul>
                        <li class="footer-title">Gethype</li>
                        <li><a href="{{ URL::to('/about') }}">About Us</a></li>
                        <li><a>Events</a></li>
                        <li><a>Partners</a></li>
                        <li><a>Services</a></li>
                        <li><a>What we do</a></li>
                        <li><a>Journals</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 footer-main-col">
                    <ul>
                        <li class="footer-title">Get in Touch</li>
                        <li><a href="{{ URL::to('contact') }}">Contact Us</a></li>
                        <li><a>Instagram</a></li>
                        <li><a>Facebook</a></li>
                        <li><a>Twitter</a></li>
                    </ul>
                </div>
                <div class="col-sm-5 footer-main-col" style="padding-top: 2em; font-weight: 100">
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
