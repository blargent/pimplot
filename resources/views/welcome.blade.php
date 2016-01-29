@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to LotStatusReport.com</div>

                <div class="panel-body">
                    <p>The Community / Map selector page (with login and admin menu) will be located here early next week.</p>
                    <p>For now, please <a href="{{ URL::action('LotInfosController@alpha') }}">click here to review the Lot Editor</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
