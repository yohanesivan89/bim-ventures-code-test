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
                        <th>Trx No</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listTrx as $trx)
                        <tr>
                            <td>{{$trx->id}}</td>
                            <td>{{$trx->user->email}}</td>
                            <td>{{number_format($trx->unpaid_amount , 2, '.', ',')}}</td>
                            <td>{{getTrxStatus($trx->unpaid_amount, $trx->due_date)}}</td>
                            <td>{{$trx->due_date}}</td>
                            <td><a href="{{route('admin.payment.detail', $trx->id)}}"><button class="btn btn-primary">Add Payment</button></a></td>
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
<!-- end plugin css for this page -->
@endsection

@section('customjs')
<!-- plugin js for this page -->
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script>
    var table = $('#dataDash').DataTable();
</script>
@endsection