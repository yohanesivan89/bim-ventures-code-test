@extends('layouts.index')

@section('title')
<title>{{env('APP_NAME')}} - Laporan</title>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Laporan</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cabang</th>
                        <th>Device</th>
                        <th>Temp 1.</th>
                        <th>Temp Control 1.</th>
                        <th>Temp 2.</th>
                        <th>Temp Control 2.</th>
                        <th>Cal 1.</th>
                        <th>Cal 2.</th>
                        <th>Latest Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listDevice as $device)
                        <tr data-toggle="modal" data-target=".bd-example-modal-xl" class="modalload" device-name="{{@$device->name}}" onclick="rowClick(this)">
                            <td>{{$loop->iteration}}</td>
                            <td>{{@$device->mdevice->cabang->nama}}</td>
                            <td>{{@$device->name}}</td>
                            <td>{{@$device->value1}}</td>
                            <td>{{@$device->value2}}</td>
                            <td>{{@$device->value9}}</td>
                            <td>{{@$device->value10}}</td>
                            <td>{{@$device->value3}}</td>
                            <td>{{@$device->value11}}</td>
                            <td>{{date('Y-m-d H:i:s', strtotime($device->created_at))}}</td>
                            @if ($device->mdevice->status == "1")
                                <td><div class="green-circle">1</div></td>
                            @else
                                <td><div class="red-circle">0</div></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Large modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalDetail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">History Temp</h6>
                                <canvas id="chartjsArea"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Detail History Temp</h6>
                                <div class="row pl-2 pb-3" id="exportbuttoncontainer">
                                </div>
                                <div class="table-responsive">
                                    <table id="dataLaporan" class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Device</th>
                                                <th>Temp 1.</th>
                                                <th>Temp Control 1.</th>
                                                <th>Temp 2.</th>
                                                <th>Temp Control 2.</th>
                                                <th>Cal 1.</th>
                                                <th>Cal 2.</th>
                                                <th>Send Data</th>
                                                <th>Batt lvl</th>
                                                <th>Ping</th>
                                                <th>Notif</th>
                                                <th>Latest Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js" charset="utf8"></script>
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="../../../assets/vendors/chartjs/Chart.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script src="../../../assets/js/data-table.js"></script>
<script src="../../../assets/js/chartjs.js"></script>
  <!-- end custom js for this page -->

<script>
    var chartArea;

    function loadTable(data)
    {
        var table = $('#dataLaporan').DataTable({
            "data" : data,
            "columns" : [
                { "data" : "no" },
                { "data" : "name" },
                { "data" : "value1" },
                { "data" : "value2" },
                { "data" : "value9" },
                { "data" : "value10" },
                { "data" : "value3" },
                { "data" : "value11" },
                { "data" : "value8" },
                { "data" : "value4" },
                { "data" : "value6" },
                { "data" : "value7" },
                { "data" : "created_at", render: function (data, type, row, meta) {
                    var newDate = new Date(row.created_at);
                    return newDate.toLocaleString();
                }},
            ],
            "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                search: ""
            },
            "bDestroy": true
        });

        new $.fn.dataTable.Buttons( table, {
            buttons: [
                {
                    extend:    'copy',
                    text:      'Copy',
                    titleAttr: 'Copy',
                    className: 'btn btn-primary'
                },
                {
                    extend:    'csv',
                    text:      'CSV',
                    titleAttr: 'CSV',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend:    'excel',
                    text:      'Excel',
                    titleAttr: 'Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                },   
                {
                    extend:    'print',
                    text:      'PDF',
                    titleAttr: 'PDF',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        } );

        table.buttons().container().appendTo( '#exportbuttoncontainer' );
    }

    $('#modalDetail').on('hidden.bs.modal', function () {
        document.title = "ESP - Laporan ";
        chartArea.destroy();
    })

    $('.modalload').click(function() {
        let deviceName = $(this).attr('device-name');
        let temp = [];
        let date = [];
        document.title = "ESP - Laporan "+deviceName;
        $.get( "{{route('laporan.modalchart')}}?name="+deviceName, function( data ) {
            data.forEach(element => {
                temp.push(element['value1']);
                let tempDate = new Date(element['created_at']) + "";
                date.push(tempDate.substring(0, 10));
            });
            loadTable(data);
            loadChart(temp, date);
        });
    });

    function loadChart(temp, date)
    {
        chartArea = new Chart($('#chartjsArea'), {
            type: 'line',
            data: {
                labels: date.reverse(),
                datasets: [{ 
                        data: temp.reverse(),
                        label: "Temp(°C)",
                        borderColor: "#344258",
                        backgroundColor: "#7091C7",
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Date'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                max: Math.round(Math.max(...temp)+5),
                                min: Math.round(Math.min(...temp)-5)
                            }
                        }]
                },
            }
        });
    }
</script>
@endsection