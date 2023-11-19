@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - User</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Tambah User</h6>
        <form class="forms-sample" method="POST" action="{{route('user.create')}}">
			@csrf
            <div class="form-group row pb-0 pb-md-2">
				<div class="col-md-3 mb-4 mb-md-0">
					<label>Cabang</label>
					<select class="js-example-basic-single w-100" data-width="100%" name="inCabang" required>
						@foreach ($listcabang as $cabang)
							<option value="{{$cabang->id}}">{{$cabang->nama}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<label for="inputUser">Email</label>
                	<input type="email" name="inEmail" class="form-control mb-4 mb-md-0" id="inputUser" autocomplete="off" placeholder="Email" required>
				</div>
				<div class="col-md-3">
					<label>Phone</label>
					<input class="form-control mb-4 mb-md-0" name="inPhone" data-inputmask-alias="(+62) 9999-9999-999" required/>
				</div>
				<div class="col-md-3">
					<label for="inputName">Name</label>
                	<input type="text" class="form-control mb-4 mb-md-0" name="inName" id="inputName" autocomplete="off" placeholder="Name" required>
				</div>
			</div>
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-3">
					<label for="inputPassword">Password</label>
                	<input type="password" name="inPassword" class="form-control mb-4 mb-md-0" id="inputPassword" autocomplete="off" placeholder="Password" required>
				</div>
				<div class="col-md-3">
					<label>Status</label>
					<select class="js-example-basic-single w-100" name="inStatus" data-width="100%" required>
						<option value="1">Active</option>
						<option value="0">Non Active</option>
					</select>
				</div>
				<div class="col-md-3 mb-4 mb-md-0">
					<label>Level</label>
					<select class="js-example-basic-single w-100" name="inRole" data-width="100%" required>
						<option value="1">Staff Gudang</option>
						<option value="2">Teknisi Pusat</option>
						<option value="3">Manager Gubeng</option>
						<option value="4">Manager Pusat</option>
						<option value="5">Administrator</option>
					</select>
				</div>
			</div>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <button class="btn btn-light">Batal</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h6 class="card-title">List User</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID / Email</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
					@foreach ($listuser as $user)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->dcabang->nama}}</td>
							@php
								$role = '';
								switch ($user->role) {
									case '1':
										$role = 'Staff Gudang';
										break;
									case '2':
										$role = 'Teknisi Pusat';
										break;
									case '3':
										$role = 'Manager Gubeng';
										break;
									case '4':
										$role = 'Manager Pusat';
										break;
									case '5':
										$role = 'Administrator';
										break;
								}
							@endphp
							<td>{{$role}}</td>
							@if ($user->status == '1')
								<td>Active</td>
							@else
								<td>Non Active</td>
							@endif
							<td><button class="btn btn-primary">Edit</button></td>
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
	<link rel="stylesheet" href="../../../assets/vendors/select2/select2.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/dropzone/dropzone.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/dropify/dist/dropify.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
	<!-- end plugin css for this page -->
  	<!-- Layout styles -->  
	<link rel="stylesheet" href="../../../assets/css/demo_1/style.css">
 	 <!-- End layout styles -->
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

	<script>
		$('#idStatus').on('change', function(){
			if(this.checked)
			{
				$('#statusDev').html('Online');
			}else{
				$('#statusDev').html('Offline');
			}
		})
	</script>
@endsection