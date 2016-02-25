@extends('layouts.newreports')

@section('content')
    <table class="table table-bordered" id="lot_defs-table">
        <thead>
        <tr>
            <th>Lot #</th>
            <th>Name</th>
            <th>Status</th>
            <th>Build Type</th>
            <th>FV Install Date</th>
            <th>Builder Date</th>
            <th>Adjust To Date</th>
            <th>Critical Flag</th>
            <th>Verify no update</th>
            <th>Notes</th>
            <th>Most Recent Update</th>
            <th>Updated By</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#lot_defs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                { data: 'latestlotinfo.lot_num', name: 'lot_num' },
                { data: 'latestlotinfo.lot_name', name: 'lot_name' },
                { data: 'latestlotinfo.statusdef.label', name: 'status_id' },
                { data: 'latestlotinfo.buildtype.label', name: 'build_type_id' },
//                { data: 'build_type_id', name: 'build_type_id' },
                { data: 'latestlotinfo.fv_install_date', name: 'fv_install_date' },
                { data: 'latestlotinfo.builder_date', name: 'builder_date' },
                { data: 'latestlotinfo.adjust_date_to', name: 'adjust_date_to' },
                { data: 'latestlotinfo.critical_issue_flag', name: 'critical_issue_flag' },
                { data: 'latestlotinfo.verify_no_update', name: 'verify_no_update' },
                { data: 'latestlotinfo.notes', name: 'notes' },
                { data: 'latestlotinfo.created_at', name: 'created_at' },
                { data: 'latestlotinfo.user.name', name: 'user_id' }
            ]
        });
    });
</script>
@endpush

