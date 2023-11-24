@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Dashboard</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Transaction List</h6>
        <div class="table-responsive">
            <table id="dataDash" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cabang</th>
                        <th>Device</th>
                        <th>Temp 1.</th>
                        <th>Temp 2.</th>
                        <th>Batt lvl</th>
                        <th>Latest Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('customcss')
<!-- plugin css for this page -->
<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<!-- end plugin css for this page -->
@endsection

@section('customjs')
<!-- plugin js for this page -->
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script>
    /*var table = $('#dataDash').DataTable({
        "ajax" : {
            url: '',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
            }
        },
        "columns" : [
            { "data" : "no" },
            { "data" : "nama" },
            { "data" : "name" },
            { "data" : "value1" },
            { "data" : "value9" },
            { "data" : "value4" },
            { "data" : "created_at", render: function (data, type, row, meta) {
                    var newDate = new Date(row.created_at);
                    return newDate.toLocaleString();
                }
            },
            { "data" : "status", render: function (data, type, row, meta) {
                    if(row.status == 1)
                    {
                        return `<div class="green-circle">1</div>`;
                    }else{
                        return `<div class="red-circle">0</div>`;
                    }
                }
            },
        ],
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        },
    });*/
</script>
@endsection