<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
// $(function() {
//               $('.lotShow').on('click', function (e) {
//                   var lotnum = $(this).attr('data-lotnum');
//                   alert('lot #: ' +lotnum);
//               });
//            });
                $('#showLotInfo').on('show.bs.modal', function(event) {
                    var clickedItem = $(event.relatedTarget);
                    var lotNumber = clickedItem.data('lotnum');

                    console.log('showLotInfo jq lotNum: ' +lotNumber);

                    var modal = $(this);
                    modal.find('.modal-title').text('Viewing data for Lot: ' +lotNumber);
                    modal.find('.modal-body input').val(lotNumber);
                });
            });
        </script>


    </head>
    <body>
        <div class="container">
            <img src="../img/LaytonLakesSummitTrim.jpg" name="laytonlakessummit" width="644" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />
            <p>
{{--                {!! Html::image('../img/LaytonLakesSummit.jpg')  !!}--}}
                <map name="summit_laytonlakes" id="summit_laytonlakes">
                    @foreach($lotdefs as $lotdef)
                        <area shape="{{ $lotdef->map_area_shape }}"
                              coords="{{ $lotdef->map_area_coords  }}"
                              data-lotnum="{{ $lotdef->lot_num }}"
                              data-toggle="modal"
                              data-target="#showLotInfo"
                              class="lotShow"
                              {{--href="javascript:alert('lot#: {{ $lotdef->lot_num }}');"--}}
                              alt="Lot: {{ $lotdef->lot_num  }} Plan: {{ $lotdef->plan_num  }}" />
                    @endforeach


                </map>
            </p>

            <div class="content">
                {{--<p>--}}
                    {{--<img src="/img/LaytonLakesSummit.jpg" name="laytonlakessummit" width="1269" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />--}}
                {{--</p>--}}

                {{--{{ $lotmap }}--}}
                <hr>

                {{--@foreach($lotdefs as $lotdef)--}}
                    {{--<a href="javascript:alert('lot#: {{ $lotdef->lot_num }}');" id="{{ $lotdef->lot_num }}">{{ $lotdef->lot_num }}</a>--}}
                    {{--<br/>--}}

                {{--@endforeach--}}


                {{--<div class="title">Laravel 5</div>--}}
            </div>
        </div>
        <div class="modal fade" id="showLotInfo" tabindex="-1" role="dialog" aria-labelledby="showLotInfoLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancel"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="showLotInfoLabel">New message</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="lot-num" class="control-label">Lot Number:</label>
                                <input type="text" class="form-control" id="lot-num">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
