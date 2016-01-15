<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

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

            <p>
                <!--<img src="{{ asset('public/img/LaytonLakesSummit.jpg')  }}" name="laytonlakessummit" width="644" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />-->
                {{ HTML::image('img/LaytonLakesSummit.jpg')  }}
                <map name="summit_laytonlakes" id="summit_laytonlakes">
                    <area shape="rect" coords="415,437,450,501" href="#" alt="lot_022" />
                    <area shape="rect" coords="377,438,411,500" href="#" alt="lot_023" />
                    <area shape="rect" coords="339,439,374,499" href="#" alt="lot_024" />
                    <area shape="rect" coords="301,441,335,498" href="#" alt="lot_025" />
                    <area shape="rect" coords="264,443,297,497" href="#" alt="lot_026" />
                    <area shape="rect" coords="225,443,259,497" href="#" alt="lot_027" />
                    <area shape="rect" coords="187,444,220,497" href="#" alt="lot_028" />
                    <area shape="rect" coords="149,444,182,496" href="#" alt="lot_029" />
                    <area shape="rect" coords="112,445,144,497" href="#" alt="lot_030" />
                    <area shape="rect" coords="100,360,134,407" href="#" alt="lot_031" />
                    <area shape="rect" coords="138,360,173,407" href="#" alt="lot_032" />
                    <area shape="rect" coords="177,361,211,406" href="#" alt="lot_033" />
                    <area shape="poly" coords="303,288,320,264,367,283,351,321" href="#" alt="lot_049" />
                    <area shape="rect" coords="265,361,299,406" href="#" alt="lot_034" />
                    <area shape="rect" coords="303,361,336,405" href="#" alt="lot_035" />
                    <area shape="rect" coords="341,361,374,404" href="#" alt="lot_036" />
                    <area shape="rect" coords="380,361,412,404" href="#" alt="lot_037" />
                    <area shape="rect" coords="417,361,450,403" href="#" alt="lot_038" />
                    <area shape="rect" coords="566,295,602,346" href="#" alt="lot_043" />
                    <area shape="rect" coords="526,296,563,345" href="#" alt="lot_044" />
                    <area shape="rect" coords="487,297,522,345" href="#" alt="lot_045" />
                    <area shape="rect" coords="448,299,482,345" href="#" alt="lot_046" />
                    <area shape="rect" coords="408,299,442,347" href="#" alt="lot_047" />
                    <area shape="poly" coords="373,288,349,348,392,347,401,295" href="#" alt="lot_048" />
                    <area shape="poly" coords="263,350,297,296,348,328,339,350" href="#" alt="lot_050" />
                    <area shape="poly" coords="172,351,194,301,238,327,226,352" href="#" alt="lot_051" />

                    <area shape="poly" coords="199,293,219,266,260,295,242,320" href="#" alt="lot_052" />
                    <area shape="poly" coords="223,259,241,234,282,263,265,288" href="#" alt="lot_053" />
                    <area shape="poly" coords="246,229,264,202,305,233,287,257" href="#" alt="lot_054" />
                    <area shape="poly" coords="269,197,286,174,326,202,310,225" href="#" alt="lot_055" />
                    <area shape="poly" coords="303,148,320,123,361,152,345,177" href="#" alt="lot_056" />
                    <area shape="poly" coords="325,115,345,88,381,121,367,145" href="#" alt="lot_057" />
                    <area shape="poly" coords="351,81,359,70,403,56,419,59,408,107,386,113" href="#" alt="lot_058" />
                    <area shape="poly" coords="428,61,460,67,449,123,416,111" href="#" alt="lot_059" />
                    <area shape="poly" coords="467,70,496,76,495,126,457,125" href="#" alt="lot_060" />
                    <area shape="rect" coords="503,77,537,127" href="#" alt="lot_061" />
                    <area shape="rect" coords="560,157,593,207" href="#" alt="lot_062" />
                    <area shape="rect" coords="522,158,555,207" href="#" alt="lot_063" />
                    <area shape="rect" coords="484,158,517,207" href="#" alt="lot_064" />
                    <area shape="rect" coords="560,216,593,265" href="#" alt="lot_072" />
                    <area shape="rect" coords="521,216,555,264" href="#" alt="lot_071" />
                    <area shape="rect" coords="483,217,517,264" href="#" alt="lot_070" />
                    <area shape="poly" coords="448,154,475,159,478,207,438,207" href="#" alt="lot_065" />
                    <area shape="poly" coords="413,146,440,154,428,202,384,189" href="#" alt="lot_066" />
                    <area shape="poly" coords="378,197,347,237,383,254,401,205" href="#" alt="lot_067" />
                    <area shape="poly" coords="412,208,437,218,439,264,395,261" href="#" alt="lot_068" />
                    <area shape="rect" coords="448,218,478,264" href="#" alt="lot_069" />
                </map>
            </p>

            <div class="content">
                <p>
                    <img src="/img/LaytonLakesSummit.jpg" name="laytonlakessummit" width="1269" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />
                </p>

                {{ $lotmap }}
                <hr>
                @foreach($lotdefs as $lotdef)
                    <a href="javascript:alert('lot#: {{ $lotdef->lot_num }}');" id="{{ $lotdef->lot_num }}">{{ $lotdef->lot_num }}</a>
                    <br/>

                @endforeach


                <div class="title">Laravel 5</div>
            </div>
        </div>
    </body>
</html>
