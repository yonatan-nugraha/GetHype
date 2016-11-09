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
    <link rel="icon" href="{{ asset('images/logo-dark.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sticky-footer-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
    @yield('styles')
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="content-flex">
        <div class="main-content-flex">
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
                            <img src="{{ asset('images/logo-gold.png') }}">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
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
                                            <a href="{{ url('/orders') }}">Order History</a>
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
        </div>
    </div>

    <footer class="footer footer-noflex">
        <div class="container">
            <div class="row footer-main">
                <div class="col-sm-3">
                    <img src="{{ asset('images/logo-gold.png') }}">
                </div>
                <div class="col-sm-2 col-xs-6">
                    <ul>
                        <li class="footer-list-title">Gethype</li>
                        <li class="footer-list"><a href="{{ url('about-us') }}">About Us</a></li>
                        <li class="footer-list"><a href="{{ url('events/search') }}">Events</a></li>
                        <li class="footer-list"><a href="{{ url('services') }}">Services</a></li>
                        <li class="footer-list"><a href="{{ url('journals') }}">Journals</a></li>
                        <li class="footer-list"><a href="{{ url('help') }}">Help</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-xs-6">
                    <ul>
                        <li class="footer-list-title">Get in Touch</li>
                        <li class="footer-list"><a href="{{ url('contact-us') }}">Contact Us</a></li>
                        <li class="footer-list"><a>Instagram</a></li>
                        <li class="footer-list"><a>Facebook</a></li>
                        <li class="footer-list"><a>Twitter</a></li>
                    </ul>
                </div>
                <div class="col-sm-5 col-xs-12 subscribe">
                    <p class="subscribe-title">Subscribe Now</p>
                    <span class="subscribe-description">Providing you the latest info about Gethype & best offering for your needs.</span>

                    <p class="subscribe-form">
                        <div class="input-group">
                            <input type="text" class="form-control subscribe-email" placeholder="Email Address">
                            <span class="input-group-addon subscribe-submit" id="basic-addon2">SUBMIT</span>   
                        </div>
                    </p>
                    <p id="subscribe-message"></p>
                </div>
            </div>
            <div class="row footer-secondary">
                <img src="{{ asset('images/img-additional-2.png') }}">
                <p>2016 | Gethype.co.id</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/date.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

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
