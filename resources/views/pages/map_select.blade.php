@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Community and Map Selection Page</div>
                    <div class="panel-body">
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                        {{--<form class="form-horizontal" role="form" method="GET" action="{{ url('/mapa') }}">--}}
                        <form class="form-horizontal" role="form" method="GET" action="{{ url('/mapa') }}">
                            {!! csrf_field() !!}


                            <div class="form-group">
                                {{--<label class="col-md-4 control-label">Community:</label>--}}
                                <label class="col-md-4 control-label">Customer:</label>
                                <div class="col-md-6">
                                    <select id="community" class="form-control" name="community_id">
                                        <option value=""></option>
                                        @foreach($communities as $community)
                                            <option value=" {{ $community->id }} ">{{ $community->community_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Subdivision:</label>
                                <div class="col-md-6">
                                    <select id="subdivision" class="form-control" name="subdivision_id">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Map:</label>
                                <div class="col-md-6">
                                    <select id="map" class="form-control" name="map_id">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        $(document).ready(function(){

            $('#community').on('change', function(e) {
               var community_id = e.target.value;
                event.preventDefault();
                console.log('community_id: ' +community_id);
                if (community_id && community_id > 0) {

                    var request = $.ajax({
                        url: 'api/mapselection/getsubdivisions/' + community_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (jdata) {
//                            console.log('success: [jdata]: ' +jdata.data);
                            $('#subdivision').empty();
                            $('#map').empty();
                            if (jdata.count > 0) {
                                $('#subdivision').prop('disabled', false);
                                $('#subdivision').append("<option value='0'>Choose One....</option>");
                                //                        $.each(jdata, function(key, element) {
                                $.each(jdata.data, function (index, element) {
                                    //                            $('#subdivision').append("<option value='" +jdata.id +"'>" +jdata.subdivision_name +"</option>");
                                    $('#subdivision').append("<option value='" + element.id + "'>" + element.subdivision_name + "</option>");
                                });
                            }
                            else {
                                $('#subdivision').append("<option value='0'>No subdivisions available</option>");
                                $('#subdivision').prop('disabled', true);
                            }
                        }
                    });
                    {{--request.done(function() {--}}
                    {{--request.fail(function( jqXHR, textStatus ) {--}}
                    {{--alert( "Whoops! There was an error (or no initial data) processing data for Lot: " +lotNumber +". Please try again. " + textStatus );--}}
                    {{--});--}}
                }
                else {
                    $('#subdivision, #map').empty();
                }
            });

            $('#subdivision').on('change', function(e) {
                var subdivision_id = e.target.value;
                event.preventDefault();
                console.log('subdivision_id: ' +subdivision_id);
                if (subdivision_id && subdivision_id > 0) {

                    var request = $.ajax({
                        url: 'api/mapselection/getmaps/' + subdivision_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (jdata) {
//                            console.log('success: [jdata]: ' + jdata.data);
                            $('#map').empty();
                            console.log('jdata.count: ' +jdata.count);
                            if (jdata.count > 0) {
                                $('#map').append("<option value='0'>Choose One....</option>");
//                                $('#map').removeProp('disabled');
                                $('#map').prop("disabled", false);
                                $.each(jdata.data, function (index, element) {
                                    $('#map').append("<option value='" + element.id + "'>" + element.map_name + "</option>");
                                });
                            }
                            else {
                                $('#map').append("<option value='0'>No maps available</option>");
                                $('#map').prop('disabled', true);
                            }
                        }
                    });
                }
                else {
                    $('#map').empty();
                }
            });

        }); // /document.ready
    </script>
@endsection

