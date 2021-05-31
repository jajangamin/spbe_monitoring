<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.monitoringjaringan.create') }}" method="post">
        @csrf
        <div class="form-group">

{{--            <p>Nama Aplikasi : <strong>{{ $maplikasi->nama_aplikasi }}</strong></p>--}}
{{--            <p>Link : <strong>{{ $maplikasi->link}}</strong></p>--}}
{{--            <p>Unit Kerja : <strong>{{ $maplikasi->nama_unit }}</strong></p>--}}
{{--            <p>status : <strong>{{ $maplikasi->status }}</strong></p>--}}
        </div>

        <div class="form-group">
            <label>Nama OPD</label>
            <select class="form-control" name="idjaringan" id="idjaringan" required>
                <option value="" selected disabled>-- Pilih OPD --</option>
                @foreach ($jaringan as $data)
                    <option value="{{ $data->id }}">{{ $data->opd }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value="" selected disabled>-- Pilih Status --</option>
                <option value="UP">UP </option>
                <option value="DOWN">DOWN</option>
                <option value="OFF">OFF</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Error</label>
            <input type="text" id="tgl_error" name="tgl_error" value={{date('Y-m-d H:i:s')}} required>
        </div>

            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Kirim</strong></button>

    </form>
</div>

<script>
    $('#tgl_error').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
</script>
<p></p>

