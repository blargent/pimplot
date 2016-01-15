<!DOCTYPE html>
<html>
    <head>
        <title>Lot Edit prototype :: major unfinished!</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

 {{--       <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>--}}
    </head>
    <body>
        <div class="container">
            <img src="../img/LaytonLakesSummitTrim.jpg" name="laytonlakessummit" width="644" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />
            <p>
{{--                {!! Html::image('../img/LaytonLakesSummit.jpg')  !!}--}}
                <map name="summit_laytonlakes" id="summit_laytonlakes">
                    @foreach($lotdefs as $lotdef)
                        <area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="javascript:alert('lot#: {{ $lotdef->lot_num }}');" alt="Lot: {{ $lotdef->lot_num  }} Plan: {{ $lotdef->plan_num  }}" />
                    @endforeach


                </map>
            </p>

            <div class="content">
                {{--<p>--}}
                    {{--<img src="/img/LaytonLakesSummit.jpg" name="laytonlakessummit" width="1269" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />--}}
                {{--</p>--}}

                {{ $lotdefs }}
                <hr>
                {{--@foreach($lotdefs as $lotdef)--}}
                    {{--<a href="javascript:alert('lot#: {{ $lotdef->lot_num }}');" id="{{ $lotdef->lot_num }}">{{ $lotdef->lot_num }}</a>--}}
                    {{--<br/>--}}

                {{--@endforeach--}}


                {{--<div class="title">Lot Edit prototype :: major unfinished!</div>--}}
            </div>
        </div>
    </body>
</html>
