@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Settings</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">List Settings</h6>
        <form class="forms-sample" method="POST" action="{{route('setting.create')}}">
			@csrf
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-3">
					<label for="apikey">Api Key</label>
                	<input required type="text" name="API_KEY" class="form-control mb-4 mb-md-0" id="apikey" autocomplete="off" placeholder="API KEY" value="{{$settings->where('key','API_KEY')->first()->value}}" required>
				</div>
				<div class="col-md-3">
					<label for="watoken">WABLAS Token</label>
                	<input required type="text" name="WA_TOKEN" class="form-control mb-4 mb-md-0" id="watoken" autocomplete="off" placeholder="WABLAS Token" value="{{$settings->where('key','WA_TOKEN')->first()->value}}" required>
				</div>
			</div>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <button class="btn btn-light" type="button">Batal</button>
        </form>
    </div>
</div>
@endsection

@section('customcss')
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="../../../assets/vendors/select2/select2.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/dropzone/dropzone.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/dropify/dist/dropify.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<!-- endinject -->
	<link rel="stylesheet" href="../../../assets/css/demo_1/style.css">
@endsection

@section('customjs')
	<!-- plugin js for this page -->
	<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
	<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
	<script src="../../../assets/vendors/jquery-validation/jquery.validate.min.js"></script>
	<script src="../../../assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
	<script src="../../../assets/vendors/inputmask/jquery.inputmask.min.js"></script>
	<script src="../../../assets/vendors/select2/select2.min.js"></script>
	<script src="../../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
	<script src="../../../assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
	<script src="../../../assets/vendors/dropzone/dropzone.min.js"></script>
	<script src="../../../assets/vendors/dropify/dist/dropify.min.js"></script>
	<script src="../../../assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
	<script src="../../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../../../assets/vendors/moment/moment.min.js"></script>
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
@endsection
