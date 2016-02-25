@extends('layouts.newreports3')

@section('content')
    {!! Datatable::table()
     ->addColumn('Lot Num', 'Lot Name', 'Status', 'Notes', 'User')
     ->setUrl(URL::to('api/lis'))
     ->setOptions(array('bServerSide' => false))
     ->render();
     !!}

@stop

{{--@push('scripts')--}}
{{--<script>--}}
    {{--$(function() {--}}
        {{--$('#lot_defs-table').DataTable({--}}
            {{--processing: true,--}}
            {{--serverSide: true,--}}
            {{--ajax: '{!! route('datatables.data') !!}',--}}
            {{--columns: [--}}
                {{--{ data: 'latestlotinfo.lot_num', name: 'lot_num' },--}}
                {{--{ data: 'latestlotinfo.lot_name', name: 'lot_name' },--}}
                {{--{ data: 'latestlotinfo.statusdef.label', name: 'status_id' },--}}
                {{--{ data: 'latestlotinfo.buildtype.label', name: 'build_type_id' },--}}
{{--//                { data: 'build_type_id', name: 'build_type_id' },--}}
                {{--{ data: 'latestlotinfo.fv_install_date', name: 'fv_install_date' },--}}
                {{--{ data: 'latestlotinfo.builder_date', name: 'builder_date' },--}}
                {{--{ data: 'latestlotinfo.adjust_date_to', name: 'adjust_date_to' },--}}
                {{--{ data: 'latestlotinfo.critical_issue_flag', name: 'critical_issue_flag' },--}}
                {{--{ data: 'latestlotinfo.verify_no_update', name: 'verify_no_update' },--}}
                {{--{ data: 'latestlotinfo.notes', name: 'notes' },--}}
                {{--{ data: 'latestlotinfo.created_at', name: 'created_at' },--}}
                {{--{ data: 'latestlotinfo.user.name', name: 'user_id' }--}}
            {{--]--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
{{--@endpush--}}

