@extends('layouts.newreports3')

@section('content')
    <div class="page-header">
        <h1>Lot Info Report :: Raw LotInfo Data, now SORTABLE</h1>
        <p class="lead">Lot Info data is now displaying only the most recent data <i>per lot</i> and is now fully <strong>sortable</strong>. Not only is it sortable, after clicking on a header to sort by, you can hold down SHIFT and click on a different header to sub-sort <i>within</i> the currely sorted layout. Cool.</p>
    </div>


    {!! Datatable::table()
     ->addColumn('Lot #', 'Lot Name', 'Status', 'Critical Issue!', 'Build Type',  'Notes', 'Builder Date', 'Earliest Possible Date', 'Last Updated At', 'No Update Flag', 'Last User')
     ->setUrl(URL::to('api/lis'))
     ->setOptions(array(
         'bServerSide' => false,
         'stripeClasses' => ['strip1', 'strip2'],
         'info' => true,
         'processing' => true,
         'style' => 'display')
     )
     ->render();
     !!}
@stop
