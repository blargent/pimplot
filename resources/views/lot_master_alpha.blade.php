<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lot Edit prototype</title>
    <script>
        var clickedItem, lotNumber, lotId, lotNotes, lotStatusId, lotTitle, lotPriority, mode, formChanged = false;
    </script>

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.11.3/jquery.min.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.11.3/jquery.min.js"></script>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lotBox :input").change(function() {
                formChanged = true;
//                console.log('formChanged: ' +formChanged);
            });
            $("#lot-notes").on('change keyup', function () {
               formChanged = true;
//                console.log('formChanged [text]: ' +formChanged);
            });

            $('.lotShow').on('click', function(event) {
                $('#showLotInfoLabel').text('LSR -- Getting data...');

                lotId       = $(this).data('lot_id');
                lotNumber   = $(this).data('lotnum');
                lotPriority = $(this).data('lot_priority');

                var request = $.ajax({
                    url: 'api/lotinfo/' +lotId,
                    success: function(jdata) {
                        console.log(jdata);

                        $('#lot-num').val(lotNumber);

                        if ( (jdata.count > 0) && (jdata.rdata) ) {
                            mode        = 'update';
                            lotNotes    = jdata.rdata.notes;
                            lotStatusId = jdata.rdata.status_id;
                            lotTitle    = 'LSR -- Data ready for Lot: ';
//                            lotPriority = jdata.rdata.priority;
                        }

                        else {
                            mode        = 'new';
                            lotNotes    = '';
                            lotStatusId = 0;
                            lotTitle    = 'LSR -- No data found. Ready to record data for Lot: ';

                        }
                        $('#lot-notes').val(lotNotes);
                        $('#status-id').val(lotStatusId);
                        $('#lot-history-num').val(jdata.count);
                        $('#priority-id').val(lotPriority);
//                        console.log('mode: ' +mode);
                    }
                });

                request.done(function() {
                    $('#showLotInfoLabel').text(lotTitle +lotNumber);
                });

                request.fail(function( jqXHR, textStatus ) {
                    //$('#showLotInfoLabel').text('LSR -- No data (or error) for Lot: ' +lotNumber);
                    alert( "Whoops! There was an error (or no initial data) processing data for Lot: " +lotNumber +". Please try again. " + textStatus );
                });
                event.preventDefault();
            });

            $("#modalSave").on('click', function(event) {
//            $("#lotBox").on('submit', function(event) {
                event.preventDefault();

                //var fData = $(this).serialize();

                var formData = {
                    lot_id:     lotId,
                    lot_num:    lotNumber,
                    lot_notes:  $('#lot-notes').val(),
                    lot_status: $('#status-id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        //'X-XSRF-Token': $('input[name="_token"]').val()
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

//                console.log(formData);

                $.ajax({
                    url:    'api/lotinfo/' +lotId,
                    type:   'POST',
                    data:   formData,
                    success: function (pdata) {
                        $("#showLotInfo").modal('hide');
                    },
                    error: function (edata) {
//                        console.log('Error from POST: ', edata);
                    }
                });
                formChanged = false;
                event.preventDefault();
            });
        });
    </script>


</head>
<body>
<div class="container">
    <img src="../img/LaytonLakesSummitTrim.jpg" name="laytonlakessummit" width="644" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />
    <map name="summit_laytonlakes" id="summit_laytonlakes">
        @foreach($lotdefs as $lotdef)
            {{--<area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="#" data-lotnum="{{ $lotdef->lot_num }}" data-lotid="{{ $lotdef->id }}" data-lotnotes="{{ $lotdef->notes_temp }}" data-toggle="modal" data-target="#showLotInfo" class="lotShow" />--}}
            <area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="#" data-lotnum="{{ $lotdef->lot_num }}" data-lot_id="{{ $lotdef->id }}" data-lot_priority="{{ $lotdef->priority }}" data-toggle="modal" data-target="#showLotInfo" class="lotShow" />
        @endforeach
        {{--@foreach($lotdefs as $lotdef)--}}
            {{--<area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="javascript:alert('lot#: {{ $lotdef->lot_num }}');" alt="Lot: {{ $lotdef->lot_num  }} Plan: {{ $lotdef->plan_num  }}" />--}}
        {{--@endforeach--}}

    </map>
    <div class="content">
        {{--<p>--}}
        {{--<img src="/img/LaytonLakesSummit.jpg" name="laytonlakessummit" width="1269" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />--}}
        {{--</p>--}}

        {{--{{ $lotmap }}--}}
        <hr>
        {{--<div class="title">Laravel 5</div>--}}
    </div>
</div>

<div>
    <div class="modal fade" id="showLotInfo" tabindex="-1" role="dialog" aria-labelledby="showLotInfoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancel"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="showLotInfoLabel">LSR -- Initializing...</h4>
                </div>
                <div class="modal-body">
                    {{--form--}}
                    <form id="lotBox">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                            <label for="lot-num" class="control-label">Lot Number:</label>
                            <input type="text" class="form-control" id="lot-num" aria-disabled="true" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            <label for="lot-priority" class="control-label">Priority:</label>
                            <select id="priority-id" class="form-control" disabled="disabled">
                                <option value="0" selected="selected">------------</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                {{--@foreach($lotdefs as $lotdef)--}}
                                    {{--<option value="{{ $lotdef->priority }}">{{ $lotdef->priority }}</option>--}}
                                {{--@endforeach--}}
                            </select>
                            {{--<input type="text" class="form-control" id="lot-priority" aria-disabled="true" disabled="disabled">--}}
                        </div>
                        <div class="form-group">
                            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                            <label for="lot-status" class="control-label">Status:</label>
                            <select id="status-id" class="form-control">
                                <option value="0" selected="selected">------------</option>
                                @foreach($statusdefs as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_label }}  (days out: {{ $status->days_out }} )</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <label for="lot-notes" class="control-label">Notes:</label>
                            <textarea class="form-control" id="lot-notes"></textarea>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>--}}
                            {{--<label class="control-label">Upload image:</label>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            {{--<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>--}}
                            <label for="lot-history-num" class="control-label">Data history count for this lot: </label>&nbsp;<a href="javascript:alert('This will display history log here');">View history log</a>
                            <input type="text" class="form-control" id="lot-history-num" aria-disabled="true" disabled="disabled">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="modalCancel">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modalSave">Save Lot Data</button>
                    <hr>

                </div>
            </div>
        </div>
    </div>
    {{--{{ $lotdefs }}--}}
</div>
</body>
</html>