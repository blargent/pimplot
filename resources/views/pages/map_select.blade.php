@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Community and Map Selection Page</div>
                    <div class="panel-body">
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                        <form class="form-horizontal" role="form" method="GET" action="{{ url('/mapa') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Community:</label>
                                <div class="col-md-6">
                                    <select id="community_id" class="form-control" disabled="disabled">
                                        <option value="1" selected="selected">Layton Lakes</option>
                                        {{--@foreach($lotdefs as $lotdef)--}}
                                        {{--<option value="{{ $lotdef->priority }}">{{ $lotdef->priority }}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Map:</label>
                                <div class="col-md-6">
                                    <select id="map_id" class="form-control" disabled="disabled">
                                        <option value="2" selected="selected">Summit @ Layton Lakes</option>
                                        {{--@foreach($lotdefs as $lotdef)--}}
                                        {{--<option value="{{ $lotdef->priority }}">{{ $lotdef->priority }}</option>--}}
                                        {{--@endforeach--}}
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

