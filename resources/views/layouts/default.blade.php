<!DOCTYPE html>
<html>
<head>
    <title>
        @section('title')
            Lot Status Report :: Mega Report
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--<link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">--}}
    {{--<link href="{{ URL::to('assets/css/font-awesome.min.css') }}" rel="stylesheet" media="screen">--}}
    {{--<link href="{{ URL::to('assets/css/demo.css') }}" rel="stylesheet" media="screen">--}}

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}

    @yield('styles')

            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="flux clearfix">
    <div class="flux--1"></div>
    <div class="flux--2"></div>
    <div class="flux--3"></div>
    <div class="flux--4"></div>
    <div class="flux--5"></div>
</div>

<div class="container">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">Reports</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li {{ Request::is('/') ? 'class="active"' : null }}><a href="{{ URL::to('/') }}">Home</a></li>
                <li {{ Request::is('standard') ? 'class="active"' : null }}><a href="{{ URL::to('standard') }}">Standard</a></li>
                <li {{ Request::is('infinite') ? 'class="active"' : null }}><a href="{{ URL::to('infinite') }}">By Status</a></li>
                <li {{ Request::is('group') ? 'class="active"' : null }}><a href="{{ URL::to('group') }}">By something soon</a></li>
            </ul>

        </div>
    </nav>

    @yield('content')
</div>

<!-- JavaScripts -->
<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript" src="{{ URL::asset('assets/cartalyst/data-grid/js/underscore.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/cartalyst/data-grid/js/data-grid.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/moment.js') }}"></script>


@yield('scripts')

</body>
</html>