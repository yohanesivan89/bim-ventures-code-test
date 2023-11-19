@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Unknown Device</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <h6 class="card-title">Unknown Device</h6>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <button class="btn btn-danger" onclick="showSwal('passing-parameter-execute-cancel')">Delete</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTableExample" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Device</th>
                        <th>Temp 1.</th>
                        <th>Temp 2.</th>
                        <th>Batt lvl</th>
                        <th>Latest Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listData as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{@$data->value1}}</td>
                            <td>{{@$data->value9}}</td>
                            <td>{{@$data->value4}}</td>
                            <td>{{date('Y-m-d H:i:s', strtotime($data->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('customcss')
<!-- plugin css for this page -->
<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../../../assets/vendors/sweetalert2/sweetalert2.min.css">
<!-- end plugin css for this page -->
@endsection

@section('customjs')
<!-- plugin js for this page -->
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="../../../assets/vendors/sweetalert2/sweetalert2.min.js"></script>
  <script src="../../../assets/vendors/promise-polyfill/polyfill.min.js"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script src="../../../assets/js/data-table.js"></script>
<script>
$(function() {

showSwal = function(type) {
'use strict';
    if (type === 'passing-parameter-execute-cancel') {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false,
        })
        
        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'mr-2',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{route('unknown.delete')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    window.location.href = "{{route('unknown')}}";
                }
            });
            
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your file is safe',
                'error'
            )
        }
        })
    }
}
});
</script>  <!-- end custom js for this page -->
@endsection