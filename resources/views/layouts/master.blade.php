<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/js/myScript.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" class="init">
            $(document).ready(function () {
               $('#myTable').DataTable(); 
            });
        </script>
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="container-fluid">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="#">{{ trans('labels.networkConfigurator') }}</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        @yield('left_navbar')
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/en.png" width="26" class="img-rounded"/></a>
                        <a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/it.jpg" width="23" class="img-rounded"/></a>
                        @auth
                        <li><a>{{ trans('labels.welcome') }} {{ Auth::user()->name }}</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><!-- disattivo il comportamento di default del link, prevenendo la chiamata al metodo get  -->
                                Logout <span class="glyphicon glyphicon-log-out"></span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;"><!-- uso il metodo post richiesto dall'Auth Scaffold -->
                                @csrf
                            </form>
                        </li>
                        @else
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> {{ trans('labels.login') }}</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <ul class="breadcrumb pull-right">
                @yield('breadcrumb')
            </ul>
        </div>

        <div class="container">
            <header class="header-section">
                <h1>
                    @yield('titolo')
                </h1>
            </header>
        </div>
        
        @yield('corpo')
    </body>

</html>

