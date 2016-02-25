<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports (new)</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    {{--<link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">--}}
    <script src="{{ URL::to('assets/js/jquery-1.12.1.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>


<!-- App scripts -->
{{--@stack('scripts')--}}
</body>
</html>