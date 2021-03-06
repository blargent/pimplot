<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lot Edit prototype</title>
    <script>
        var clickedItem, lotNumber, lotName, lotId, lotBuildType, lotNotes, lotStatusId, lotTitle, lotPriority, mode, lot_verify_no_update, lot_critical_issue = 0, lot_fv_install_date, lot_builder_date, formChanged = false;
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

            $('input[id=lot-critical-issue]').on('change', function(e) {
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


                lotId           = $(this).data('lot_id');
                lotNumber       = $(this).data('lotnum');
//                lotName     = $(this).data('lotname');
//                lotPriority = $(this).data('priority');
//                console.log('lotShow before ajax lotName: ' +$('#lot-name').val());

                var request = $.ajax({
                    url: '/api/lotinfo/' +lotId,
                    success: function(jdata) {
                        $('#lot-num').val(lotNumber);

                        if ( (jdata.count > 0) && (jdata.rdata) ) {
//                            console.log('lotShow after ajax success lotName: ' +jdata.rdata.lot_name);
                            mode        = 'update';
                            lotName     = ((jdata.rdata.lot_name) && (jdata.rdata.lot_name != null)) ? jdata.rdata.lot_name : lotNumber;
//                            lotName     = jdata.rdata.lot_name;
                            lotNotes    = jdata.rdata.notes;

                            lotBuildType= ((jdata.rdata.build_type_id) && (jdata.rdata.build_type_id != null) && (jdata.rdata.build_type_id > 0)) ? jdata.rdata.build_type_id : 0;
                            if (lotBuildType > 0 ) {

                            }
                            else {

                            }

                            lotStatusId = ((jdata.rdata.status_id) && (jdata.rdata.status_id != null) && (jdata.rdata.status_id > 0)) ? jdata.rdata.status_id : 179;

                            if (lotStatusId > 0) {

                            }
//                            lotStatusId = ((jdata.rdata.status_id) && (jdata.rdata.status_id != null) && (jdata.rdata.status_id > 0)) ? jdata.rdata.status_id : 179;

                            lotTitle    = 'LSR -- Data ready for Lot: ';
                            lot_fv_install_date = jdata.rdata.fv_install_date;
                            lot_builder_date    = jdata.rdata.builder_date;
                            lot_critical_issue  = jdata.rdata.critical_issue_flag;
                            lotPriority = jdata.rdata.priority;
//                            console.log('lotShow after ajax success, assignment.. lotName: ' +lotName);
                        }

                        else {
                            mode        = 'new';
                            lotName     = lotNumber;
                            lotNotes    = '';
//                            lotStatusId = 179;
                            lotTitle    = 'LSR -- No data found. Ready to record data for Lot: ';
                            lot_critical_issue = 0;
                            lotPriority = 0;
//                            console.log('lotShow after ajax else, assignment.. lotName: ' +lotName);
                        }
                        $('#lot-name').val(lotName);
//                        if (lot_critical_issue == 1) {
//                            $('#lot-critical-issue').prop('checked', true).change();
//                        } else {
//                            $('#lot-critical-issue').prop('checked', false).change();
//                        }
                        $('#lot-critical-issue').prop('checked', (lot_critical_issue == 1) ? true : false).change();
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
                });
            });

            $("#modalSave").on('click', function(event) {
//            $("#lotBox").on('submit', function(event) {
                event.preventDefault();
//                console.log('click save.. lotName: ' +lotName);
                var formData = {
                    lot_id:     lotId,
                    lot_num:    lotNumber,
                    lot_name:   $('#lot-name').val(),
                    lot_notes:  $('#lot-notes').val(),
                    lot_status: $('#status-id').val(),
                    lot_verify_no_update:   $('#lot-verify-no-update').is(':checked') ? 1 : 0,
                    lot_critical_issue:     $('#lot-critical-issue').is(':checked') ? 1 : 0,
                    lot_fv_install_date:    $('#lot-fv-install-date').val(),
                    lot_builder_date:       $('#lot-builder-date').val(),
                    lot_priority:           $('#priority-id').val()
//                    lot_fv_install_date:    $('#lot-fv-install-date').datepicker("getDate"),
//                    lot_builder_date:       $('#lot-builder-date').datepicker("getDate")
                }
//                console.log(formData);

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

            $('#buildtype').on('change', function(e) {
                var buildtype_id = e.target.value;
                event.preventDefault();
//                console.log('subdivision_id: ' +subdivision_id);
                if (buildtype_id && buildtype_id != null) {
                    var request = $.ajax({
                        url: 'api/lotinfo/buildtype/' + buildtype_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (jdata) {
                            $('#status-id').empty();
//                            console.log('jdata.count: ' +jdata.count);
                            if (jdata.count > 0) {
                                $('#status-id').append("<option value='0'>Choose One....</option>");
                                $('#status-id').prop("disabled", false);
                                $.each(jdata.data, function (index, element) {
                                    $('#map').append("<option value='" + element.id + "'>" + element.label + "</option>");
                                });
                            }
                            else {
                                $('#status-id').append("<option value='0'>No statuses available</option>");
                                $('#status-id').prop('disabled', true);
                            }
                        }
                    });
                }
                else {
                    $('#status-id').empty();
                }
            });

            $('#showLotInfo').on('hidden.bs.modal', function(e) {
                $('#lot-verify-no-update, #lot-critical-issue').prop('checked', false);
                lot_critical_issue = 0;
//                $('#lot-critical-issue').val(0).change();
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
            <area shape="{{ $lotdef->map_area_shape }}" coords="{{ $lotdef->map_area_coords  }}" href="#" data-lotnum="{{ $lotdef->lot_num }}" data-lot_id="{{ $lotdef->id }}" data-toggle="modal" data-target="#showLotInfo" class="lotShow" />
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
                                    <label for="lot-num" class="control-label">Lot:</label>
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

                        <div class="form-group form-inline">
                            <div class="row">
                                {{--Lot Name--}}
                                <div class="col-md-4">
                                    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                                    <label for="lot-name" class="control-label">Lot Name:</label>
                                    <input type="text" class="form-control" id="lot-name" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{--Build Type--}}
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            <label for="lot-build-type" class="control-label">Build Type:</label>
                            <select id="buildtype" class="form-control" name="buildtype_id">
                                <option value="0">------------</option>
                            </select>
                        </div>

                        <div class="form-group">
                            {{--Status--}}
                            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                            <label for="lot-status" class="control-label">Status:</label>
                            <select id="status-id" class="form-control">
                                <option></option>
                                {{--<option value="0" selected="selected">Select Status</option>--}}
                                {{--@foreach($statusdefs as $status)--}}
                                    {{--<option value="{{ $status->id }}">{{ $status->label }}  (duration (days)): {{ $status->days_duration }} )</option>--}}
                                {{--@endforeach--}}
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



                        <div class="form-group">
                            {{--Priority--}}
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            <label for="lot-priority" class="control-label">Priority:</label>
                            <select id="priority-id" class="form-control">
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