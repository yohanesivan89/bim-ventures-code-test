@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Transaction Detail</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Transaction Details</h6>
        <table>
            <tr>
                <td>Transaction No</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{$trx->id}}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>&nbsp;:&nbsp;</td>
                <td>SAR {{number_format($trx->amount , 2, '.', ',')}}</td>
            </tr>
            <tr>
                <td>Vat</td>
                <td>&nbsp;:&nbsp;</td>
                <td>SAR {{number_format($trx->vat , 2, '.', ',')}}</td>
            </tr>
            <tr>
                <td>Nett Amount</td>
                <td>&nbsp;:&nbsp;</td>
                <td>SAR {{number_format($trx->nett_amount , 2, '.', ',')}}</td>
            </tr>
            <tr>
                <td>Outstanding Amount</td>
                <td>&nbsp;:&nbsp;</td>
                <td>SAR {{number_format($trx->unpaid_amount , 2, '.', ',')}}</td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{$trx->due_date}}</td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h6 class="card-title">Payment List</h6>
        <div class="table-responsive">
            <table id="dataDash" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Trx No</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listTrx as $trx)
                        <tr>
                            <td>{{$trx->id}}</td>
                            <td>{{number_format($trx->amount , 2, '.', ',')}}</td>
                            <td>{{$trx->created_at}}</td>
                            <td>{{$trx->desc}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h6 class="card-title">Add Payment</h6>
        <form class="forms-sample" method="POST" action="{{route('admin.payment.create')}}">
			@csrf
            <input type="hidden" name="trxid" value="{{$trx->id}}">
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-6">
					<label for="">Amount</label>
                    <input class="form-control mb-4 mb-md-0" onchange="changeAmount()" data-inputmask="'alias': 'currency'" inputmode="numeric" style="text-align: right;" name="amount" id="amount">
                </div>
                <div class="col-md-6">
					<label for="desc">Description</label>
                    <input class="form-control" name="desc" id="desc" type="text">
                </div>
			</div>
            <button type="submit" class="btn btn-primary mr-2">Add</button>
        </form>
    </div>
</div>
@endsection

@section('customcss')
<!-- plugin css for this page -->
<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<!-- end plugin css for this page -->
@endsection

@section('customjs')
<script src="../../../assets/vendors/inputmask/jquery.inputmask.min.js"></script>
<!-- plugin js for this page -->
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="../../../assets/js/bootstrap-maxlength.js"></script>
<script src="../../../assets/js/inputmask.js"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script>
    var table = $('#dataDash').DataTable();
</script>
@endsection