@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Create Transaction</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Create Transaction</h6>
        <form class="forms-sample" method="POST" action="{{route('admin.create.post')}}">
			@csrf
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-3">
					<label>User</label>
					<select class="js-example-basic-single w-100" name="iduser" data-width="100%" required>
						@if (count($listmember) > 0)
                            @foreach ($listmember as $member)
                                <option value="{{$member->id}}">{{$member->email}}</option>
                            @endforeach
                        @endif
					</select>	
				</div>
				<div class="col-md-3">
					<label for="inputKon2">Amount</label>
                    <input class="form-control mb-4 mb-md-0" onchange="changeAmount()" data-inputmask="'alias': 'currency'" inputmode="numeric" style="text-align: right;" name="amount" id="amount">
                </div>
                <div class="col-md-3">
					<label for="inputKon2">VAT</label>
                    <input class="form-control" name="vat" placeholder="VAT (%)" type="number" onchange="changeAmount()" id="vat" value="0" min="0">
                </div>
				<div class="col-md-3">
                    <div class="form-group mt-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="vatinc" onchange="changeAmount()" id="vatinc">
                                Is VAT Inclusive ?
                            <i class="input-frame"></i></label>
                        </div>
                    </div>
                </div>
				<div class="col-md-3">
					<label>Due Date</label>
					<div class="input-group date datepicker" id="datePickerExample">
                        <input type="text" class="form-control" name="duedate"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                    </div>
				</div>
			</div>
            <div class="row pt-2 pb-3">
                <div class="col-sm-12">
                    <table>
                        <tr>
                            <td>Amount</td>
                            <td>&nbsp;:</td>
                            <td id="valAmount">0</td>
                        </tr>
                        <tr>
                            <td>VAT</td>
                            <td>&nbsp;:</td>
                            <td id="valVat">0</td>
                        </tr>
                        <tr>
                            <td>Nett Amount</td>
                            <td>&nbsp;:</td>
                            <td id="valNett">0</td>
                        </tr>
                    </table>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <button class="btn btn-light" type="button">Cancel</button>
        </form>
    </div>
</div>
@endsection

@section('customcss')
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="../../../assets/vendors/select2/select2.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<!-- endinject -->
	<link rel="stylesheet" href="../../../assets/css/demo_1/style.css">
@endsection

@section('customjs')
	<!-- plugin js for this page -->
	<script src="../../../assets/vendors/jquery-validation/jquery.validate.min.js"></script>
	<script src="../../../assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
	<script src="../../../assets/vendors/inputmask/jquery.inputmask.min.js"></script>
	<script src="../../../assets/vendors/select2/select2.min.js"></script>
	<script src="../../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../../../assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>
	<!-- end plugin js for this page -->
	<!-- custom js for this page -->
	<script src="../../../assets/js/data-table.js"></script>
	<script src="../../../assets/js/form-validation.js"></script>
	<script src="../../../assets/js/bootstrap-maxlength.js"></script>
	<script src="../../../assets/js/inputmask.js"></script>
	<script src="../../../assets/js/select2.js"></script>
	<script src="../../../assets/js/typeahead.js"></script>
	<script src="../../../assets/js/tags-input.js"></script>
	<script src="../../../assets/js/dropzone.js"></script>
	<script src="../../../assets/js/dropify.js"></script>
	<script src="../../../assets/js/bootstrap-colorpicker.js"></script>
	<script src="../../../assets/js/datepicker.js"></script>
	<script src="../../../assets/js/timepicker.js"></script>
	<!-- end custom js for this page -->

	<script>
    function changeAmount()
    {
        let amount = parseFloat($('#amount').val().replace(/,/g,''));
        let vat = parseFloat($('#vat').val());

        $('#valAmount').html('SAR ' + $('#amount').val());
        $('#valVat').html(vat + '%');

        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'SAR',
        });

        if($('#vatinc').is(':checked'))
        {
            $('#valNett').html(formatter.format(amount));
        }else{
            let nettamount = amount + (amount * vat / 100);
            $('#valNett').html(formatter.format(nettamount));
        }   
    }
	</script>
@endsection