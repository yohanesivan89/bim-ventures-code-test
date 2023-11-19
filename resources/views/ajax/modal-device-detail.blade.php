<div class="form-group row pb-0 pb-md-2">
    <div class="col-md-3 mb-4 mb-md-0">
        <label>Cabang</label>
        <select class="js-example-basic-single w-100" name="cabang" data-width="100%" required>
            @foreach ($listcabang as $cabang)
                <option value="{{$cabang->id}}"
                    @if ($cabang->id == $findDev->idcabang)
                        selected
                    @endif
                    >{{$cabang->nama}}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="deviceid" value="{{$findDev->id}}">
    <div class="col-md-3">
        <label for="inputDevice">Device</label>
        <input required type="text" name="namadevice" class="form-control mb-4 mb-md-0" id="inputDevice" autocomplete="off" placeholder="Device" value="{{$findDev->name}}">
    </div>
    <div class="col-md-3">
        <label for="inputCal1">Calibration 1</label>
        <input required type="text" name="cal1" class="form-control mb-4 mb-md-0" id="inputCal1" autocomplete="off" placeholder="Calibration 1" value="{{$findDev->cal1}}">
    </div>
    <div class="col-md-3">
        <label for="inputCal2">Calibration 2</label>
        <input required type="text" name="cal2" class="form-control mb-4 mb-md-0" id="inputCal2" autocomplete="off" placeholder="Calibration 2" value="{{$findDev->cal2}}">
    </div>
</div>
<div class="form-group row pt-0 pt-md-2">
    <div class="col-md-3">
        <label for="inputKon1">Kontrol 1</label>
        <input required type="text" name="kon1" class="form-control mb-4 mb-md-0" id="inputKon1" autocomplete="off" placeholder="Kontrol 1" value="{{$findDev->kon1}}">
    </div>
    <div class="col-md-3">
        <label for="inputKon2">Kontrol 2</label>
        <input required type="text" name="kon2" class="form-control mb-4 mb-md-0" id="inputKon2" autocomplete="off" placeholder="Kontrol 2" value="{{$findDev->kon2}}">
    </div>
    <div class="col-md-3">
        <label for="inputAuth">Device Authentication</label>
        <input required type="text" name="auth" class="form-control mb-4 mb-md-0" id="inputAuth" autocomplete="off" placeholder="Device Authentication" value="{{$findDev->auth}}">
    </div>
    <div class="col-md-3 mb-4 mb-md-0">
        <label for="inputKon1">ADC offset</label>
        <input required type="text" name="adc" class="form-control mb-4 mb-md-0" id="inputadc" autocomplete="off" placeholder="ADC offset" value="{{$findDev->adc}}">
    </div>
</div>
<div class="form-group row pt-0 pt-md-2">
    <div class="col-md-3">
        <label for="inputStatus">Status</label>
        <div id="inputStatus">
            <label class="form-switch" id="tglbtn">
                <input type="checkbox" id="idStatus" name="status"
                @if ($findDev->status == 1)
                    checked
                @endif >
                <i></i>
                <span id="statusDevModal">
                    @if ($findDev->status == 1)
                        Online
                    @else
                        Offline
                    @endif
                </span>
            </label>
        </div>
    </div>
</div>

<script>
    if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2();
    }
</script>
