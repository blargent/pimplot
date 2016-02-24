@extends('layouts.newreports')

@section('content')
    <table class="table table-bordered" id="lot_infos-table">
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>
@endpush

