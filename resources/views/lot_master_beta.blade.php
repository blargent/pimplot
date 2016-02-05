<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lot Edit prototype</title>
    <script>
        var clickedItem, lotNumber, lotId, lotNotes, lotStatusId, lotTitle, lotPriority, mode, lot_verify_no_update, lot_critical_issue, lot_fv_install_date, lot_builder_date, formChanged = false;
    </script>

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    {{--<link href="//www.fuelcdn.com/fuelux/3.13.0/css/fuelux.min.css" rel="stylesheet">--}}

    <script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.11.3/jquery.min.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.11.3/jquery.min.js"></script>--}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    {{--<script src="//www.fuelcdn.com/fuelux/3.13.0/js/fuelux.min.js"></script>--}}

    <style>
        body {
            padding-right: 0px !important
        }
        .modal-open {
            overflow-y: auto;
        }
        /*i.glyph_red:before { color: red; }*/
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#lot-fv-install-date').datepicker();
            $('#lot-builder-date').datepicker();
            $('#lot-fv-install-date').datepicker("option", "dateFormat", "yy-mm-dd");
            $('#lot-builder-date').datepicker("option", "dateFormat", "yy-mm-dd");

//            $('#lot-fv-install-date').datepicker("option", "dateFormat", "mm-dd-yy");
//            $('#lot-builder-date').datepicker("option", "dateFormat", "mm-dd-yy");
//            $('#lot-fv-install-date, #lot-builder-date').datepicker();

//            $('#lot-fv-install-date, #lot-builder-date').datepicker({
//                dateFormat: "mm-dd-yy"
//            });
//            $('form').each(function(){
//                $(this).data('serialized', $(this).serialize())
//            }).on('change input', function(){
//                $(this).find('#modalSave')
//                                .prop('disabled', $(this).serialize() == $(this).data('serialized'));
//                    })
//                    .find('#modalSave')
//                    .prop('disabled', true);

//            $("#lotBox :input").change(function() {
//                formChanged = true;
//            });
//            $("#lot-notes").on('change keyup', function () {
//               formChanged = true;
//            });
//            $('#lot-verify-no-update').change(function(){
//               formChanged = true;
//                $('#modalSave').prop('disabled', false);
//            });
            $('input[id=lot-critical-issue]').on('click', function(e) {
                if ( $(this).is(':checked') ) {
                    $('.glyphicon-exclamation-sign').css('color', 'red');
                }
                else {
                    $('.glyphicon-exclamation-sign').css('color', 'black');
                }
            });

            $.ajaxSetup({
                statusCode: {
                    401: function(){
                        window.location.href = "/login";
                    }
                }
            });

            $('.lotShow').on('click', function(event) {
                event.preventDefault();
//                $("#modalSave").prop('disabled', true);
                $('#showLotInfoLabel').text('LSR -- Getting data...');


                lotId       = $(this).data('lot_id');
                lotNumber   = $(this).data('lotnum');
                lotPriority = $(this).data('lot_priority');

                var request = $.ajax({
                    url: '/api/lotinfo/' +lotId,
                    success: function(jdata) {
                        $('#lot-num').val(lotNumber);

                        if ( (jdata.count > 0) && (jdata.rdata) ) {
                            mode        = 'update';
                            lotNotes    = jdata.rdata.notes;
                            lotStatusId = jdata.rdata.status_id;
                            lotTitle    = 'LSR -- Data ready for Lot: ';
                            lot_fv_install_date = jdata.rdata.fv_install_date;
                            lot_builder_date    = jdata.rdata.builder_date;
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
                        $('#lot-fv-install-date').val(lot_fv_install_date);
                        $('#lot-builder-date').val(lot_builder_date);
                    }
                });

                request.done(function() {
                    $('#showLotInfoLabel').text(lotTitle +lotNumber);
                });

                request.fail(function( jqXHR, textStatus ) {
                    //$('#showLotInfoLabel').text('LSR -- No data (or error) for Lot: ' +lotNumber);
                    //alert( "Whoops! There was an error (or no initial data) processing data for Lot: " +lotNumber +". Please try again. " + textStatus );
                });
            });

            $("#modalSave").on('click', function(event) {
//            $("#lotBox").on('submit', function(event) {
                event.preventDefault();
                var formData = {
                    lot_id:     lotId,
                    lot_num:    lotNumber,
                    lot_notes:  $('#lot-notes').val(),
                    lot_status: $('#status-id').val(),
                    lot_verify_no_update:   $('#lot-verify-no-update').is(':checked') ? 1 : 0,
                    lot_critical_issue:     $('#lot-critical-issue').is(':checked') ? 1 : 0,
                    lot_fv_install_date:    $('#lot-fv-install-date').val(),
                    lot_builder_date:       $('#lot-builder-date').val()
//                    lot_fv_install_date:    $('#lot-fv-install-date').datepicker("getDate"),
//                    lot_builder_date:       $('#lot-builder-date').datepicker("getDate")
                }
                console.log(formData);

                $.ajaxSetup({
                    headers: {
                        //'X-XSRF-Token': $('input[name="_token"]').val()
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:    '/api/lotinfo/' +lotId,
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

            $('#showLotInfo').on('hidden.bs.modal', function(e) {
                $('#lot-verify-no-update, #lot-critical-issue').prop('checked', false);
                $('#lot-fv-install-date').datepicker("setDate");
                $('#lot-builder-date').datepicker("setDate");
                $('.glyphicon-exclamation-sign').css('color', 'black');
            });
        });
    </script>


</head>
<body>
<div class="container-fluid">
    <img src="/img/LaytonLakesSummitTrim.jpg" name="laytonlakessummit" width="644" height="527" border="0" usemap="#summit_laytonlakes" id="laytonlakessummit" />
    <map name="summit_laytonlakes" id="summit_laytonlakes">
        @foreach($lotdefs as $lotdef)
            <area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="#" data-lotnum="{{ $lotdef->lot_num }}" data-lot_id="{{ $lotdef->id }}" data-lot_priority="{{ $lotdef->priority }}" data-toggle="modal" data-target="#showLotInfo" class="lotShow" />
        @endforeach
    </map>
    <div class="content">
        {{--<hr>--}}
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
                    {{--<form id="lotBox" class="form-inline well">--}}
                        {{ csrf_field() }}

                        {{--<div class="row">--}}
                            <div class="form-group form-inline">
                                <div class="row">
                                {{--Lot Number--}}
                                {{--<div class="col-xs-12 col-md-8">--}}
                                    <div class="col-md-4">
                                        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                                        <label for="lot-num" class="control-label">Lot Number:</label>
                                    {{--</div>--}}
                                    {{--<div class="col-xs-6 col-md-4">--}}
                                        <input type="text" class="form-control" id="lot-num" aria-disabled="true" disabled="disabled" style="max-width: 60px;">
                                    </div>
                                    <div class="col-md-5 col-md-offset-3">
                                        {{--<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>--}}
                                        {{--<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color:red;"><i class="glyph_red"></i></span>--}}
                                        {{--<p class="text-right">--}}
                                        <div class="pull-right">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"</span>
                                        <label for="lot-critical-issue" class="control-label">Critical Issue!&nbsp;</label>
                                        <input type="checkbox" id="lot-critical-issue"></div>
                                        {{--</p>--}}
                                    </div>
                                </div>
                            </div>
                        {{--</div>--}}

                        <div class="form-group">
                            {{--Status--}}
                            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                            <label for="lot-status" class="control-label">Status:</label>
                            <select id="status-id" class="form-control">
                                <option value="0" selected="selected">------------</option>
                                @foreach($statusdefs as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_label }}  (days out: {{ $status->days_out }} )</option>
                                @endforeach
                            </select>
                            {{--Verify no status update--}}
                            <div class="checkbox">
                                <label for="lot-verify-no-update" class="control-label">
                                    <input type="checkbox" id="lot-verify-no-update">Verify No Status Update
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            {{--Notes--}}
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <label for="lot-notes" class="control-label">Notes:</label>
                            <textarea class="form-control" id="lot-notes"></textarea>
                        </div>

                        <div class="form-group">
                            {{--JQ fv_install_date picker--}}
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            <label for="lot-fv-install-date" class="control-label">FV Install Date:</label>
                            <input class="form-control" id="lot-fv-install-date"></input>
                        </div>

                        <div class="form-group">
                            {{--JQ builder_date picker--}}
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            <label for="lot-builder-date" class="control-label">Builder Date:</label>
                            <input class="form-control" id="lot-builder-date"></input>
                        </div>


                        {{--*******************************************************************--}}
                        {{--<div class="input-group">--}}
                            {{--<input class="form-control" id="fv-install-date" type="text"/>--}}
                            {{--<div class="input-group-btn">--}}
                                {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">--}}
                                    {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                    {{--<span class="sr-only">Toggle Calendar</span>--}}
                                {{--</button>--}}
                                {{--<div class="dropdown-menu dropdown-menu-right datepicker-calendar-wrapper" role="menu">--}}
                                    {{--<div class="datepicker-calendar">--}}
                                        {{--<div class="datepicker-calendar-header">--}}
                                            {{--<button type="button" class="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous Month</span></button>--}}
                                            {{--<button type="button" class="next"><span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next Month</span></button>--}}
                                            {{--<button type="button" class="title">--}}
              {{--<span class="month">--}}
                {{--<span data-month="0">January</span>--}}
                {{--<span data-month="1">February</span>--}}
                {{--<span data-month="2">March</span>--}}
                {{--<span data-month="3">April</span>--}}
                {{--<span data-month="4">May</span>--}}
                {{--<span data-month="5">June</span>--}}
                {{--<span data-month="6">July</span>--}}
                {{--<span data-month="7">August</span>--}}
                {{--<span data-month="8">September</span>--}}
                {{--<span data-month="9">October</span>--}}
                {{--<span data-month="10">November</span>--}}
                {{--<span data-month="11">December</span>--}}
              {{--</span> <span class="year"></span>--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                        {{--<table class="datepicker-calendar-days">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>Su</th>--}}
                                                {{--<th>Mo</th>--}}
                                                {{--<th>Tu</th>--}}
                                                {{--<th>We</th>--}}
                                                {{--<th>Th</th>--}}
                                                {{--<th>Fr</th>--}}
                                                {{--<th>Sa</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody></tbody>--}}
                                        {{--</table>--}}
                                        {{--<div class="datepicker-calendar-footer">--}}
                                            {{--<button type="button" class="datepicker-today">Today</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="datepicker-wheels" aria-hidden="true">--}}
                                        {{--<div class="datepicker-wheels-month">--}}
                                            {{--<h2 class="header">Month</h2>--}}
                                            {{--<ul>--}}
                                                {{--<li data-month="0"><button type="button">Jan</button></li>--}}
                                                {{--<li data-month="1"><button type="button">Feb</button></li>--}}
                                                {{--<li data-month="2"><button type="button">Mar</button></li>--}}
                                                {{--<li data-month="3"><button type="button">Apr</button></li>--}}
                                                {{--<li data-month="4"><button type="button">May</button></li>--}}
                                                {{--<li data-month="5"><button type="button">Jun</button></li>--}}
                                                {{--<li data-month="6"><button type="button">Jul</button></li>--}}
                                                {{--<li data-month="7"><button type="button">Aug</button></li>--}}
                                                {{--<li data-month="8"><button type="button">Sep</button></li>--}}
                                                {{--<li data-month="9"><button type="button">Oct</button></li>--}}
                                                {{--<li data-month="10"><button type="button">Nov</button></li>--}}
                                                {{--<li data-month="11"><button type="button">Dec</button></li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                        {{--<div class="datepicker-wheels-year">--}}
                                            {{--<h2 class="header">Year</h2>--}}
                                            {{--<ul></ul>--}}
                                        {{--</div>--}}
                                        {{--<div class="datepicker-wheels-footer clearfix">--}}
                                            {{--<button type="button" class="btn datepicker-wheels-back"><span class="glyphicon glyphicon-arrow-left"></span><span class="sr-only">Return to Calendar</span></button>--}}
                                            {{--<button type="button" class="btn datepicker-wheels-select">Select <span class="sr-only">Month and Year</span></button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
{{--*******************************************************************--}}



                        <div class="form-group">
                            {{--Priority--}}
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
                        {{--<div class="form-group">--}}
                            {{--<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>--}}
                            {{--<label class="control-label">Upload image:</label>--}}
                        {{--</div>--}}


                        <div class="form-group">
                            {{--<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>--}}
                            {{--Data History Count--}}
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