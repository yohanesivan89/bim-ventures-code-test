@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Device</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Tambah Device</h6>
        <form class="forms-sample" method="POST" action="{{route('device.create')}}">
			@csrf
            <div class="form-group row pb-0 pb-md-2">
				<div class="col-md-3 mb-4 mb-md-0">
					<label>Cabang</label>
					<select class="js-example-basic-single w-100" name="cabang" data-width="100%" required>
						@foreach ($listcabang as $cabang)
							<option value="{{$cabang->id}}">{{$cabang->nama}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<label for="inputDevice">Device</label>
                	<input required type="text" name="namadevice" class="form-control mb-4 mb-md-0" id="inputDevice" autocomplete="off" placeholder="Device">
				</div>
				<div class="col-md-3">
					<label for="inputCal1">Calibration 1</label>
                	<input required value="0" type="text" name="cal1" class="form-control mb-4 mb-md-0" id="inputCal1" autocomplete="off" placeholder="Calibration 1">
				</div>
				<div class="col-md-3">
					<label for="inputCal2">Calibration 2</label>
                	<input required value="0" type="text" name="cal2" class="form-control mb-4 mb-md-0" id="inputCal2" autocomplete="off" placeholder="Calibration 2">
				</div>
			</div>
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-3">
					<label for="inputKon1">Kontrol 1</label>
                	<input required value="0" type="text" name="kon1" class="form-control mb-4 mb-md-0" id="inputKon1" autocomplete="off" placeholder="Kontrol 1">
				</div>
				<div class="col-md-3">
					<label for="inputKon2">Kontrol 2</label>
                	<input required value="0" type="text" name="kon2" class="form-control mb-4 mb-md-0" id="inputKon2" autocomplete="off" placeholder="Kontrol 2">
				</div>
				<div class="col-md-3">
					<label for="inputAuth">Device Authentication</label>
                	<input required value="0" type="text" name="auth" class="form-control mb-4 mb-md-0" id="inputAuth" autocomplete="off" placeholder="Device Authentication">
				</div>
				<div class="col-md-3 mb-4 mb-md-0">
					<label for="inputKon1">ADC offset</label>
                	<input required value="0" type="text" name="adc" class="form-control mb-4 mb-md-0" id="inputadc" autocomplete="off" placeholder="ADC offset">
				</div>
			</div>
			<div class="form-group row pt-0 pt-md-2">
				<div class="col-md-3">
					<label for="inputStatus">Status</label>
					<div id="inputStatus">
						<label class="form-switch">
							<input type="checkbox" id="idStatus" name="status" checked>
							<i></i>
							<span id="statusDev">Online</span>
						</label>
					</div>
				</div>
			</div>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <button class="btn btn-light">Batal</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h6 class="card-title">List Device</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Device</th>
                        <th>Cabang</th>
                        <th>Kalibrasi 1.</th>
                        <th>Kalibrasi 2.</th>
                        <th>Kontrol 1.</th>
                        <th>Kontrol 2.</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
					@foreach ($listdevice as $device)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{@$device->name}}</td>
							<td>{{@$device->cabang->nama}}</td>
							<td>{{@$device->cal1}}</td>
							<td>{{@$device->cal2}}</td>
							<td>{{@$device->kon1}}</td>
							<td>{{@$device->kon2}}</td>
							<td><button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" onclick="loadModalDetail(this)" device-id="{{@$device->id}}">Edit</button> <button onclick="showSwal('passing-parameter-execute-cancel','{{$device->id}}')" class="btn btn-danger">Delete</button> </td>
						</tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalDetail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="forms-sample" method="POST" action="{{route('device.update')}}" id="formUpdate">
                            @csrf
                            <div id="ajaxDetailDevice"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2" onclick="submitUpdate()">Simpan</button>
                <button class="btn btn-light" data-dismiss="modal">Batal</button>
            </div>
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
    <link rel="stylesheet" href="../../../assets/vendors/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../../assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
	<!-- end plugin css for this page -->
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
    <script src="../../../assets/vendors/sweetalert2/sweetalert2.min.js"></script>
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
        $(function() {

            showSwal = function(type, id) {
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
                                url: "{{route('device.delete')}}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "iddevice": id,
                                },
                                success: function (response) {
                                    window.location.href = "{{route('device.view')}}";
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

		$('#idStatus').on('change', function(){
			if(this.checked)
			{
				$('#statusDev').html('Online');
			}else{
				$('#statusDev').html('Offline');
			}
		})

        function loadModalDetail(e) {
            let deviceId = $(e).attr('device-id');
            $.get( "{{route('device.detail')}}?deviceid="+deviceId, function( data ) {
                $('#ajaxDetailDevice').html(data);
                const status = $('#statusDevModal').html();
                if(status == 'Offline')
                {
                    $('#tglbtn').click();
                }
            });
        }

        function submitUpdate() {
            $('#formUpdate').submit();
        }
	</script>
@endsection
