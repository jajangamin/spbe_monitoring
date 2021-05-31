<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.monitoringaplikasi.kirimstatus') }}" method="post">
        @csrf
        <div class="form-group">

            <p>Nama Aplikasi : <strong>{{ $maplikasi->nama_aplikasi }}</strong></p>
            <p>Link : <strong>{{ $maplikasi->link}}</strong></p>
            <p>Unit Kerja : <strong>{{ $maplikasi->nama_unit }}</strong></p>
            <p>status : <strong>{{ $maplikasi->status }}</strong></p>
        </div>

        <div class="form-group">
            <label>Ubah Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value={{ $maplikasi->status }} selected >{{ $maplikasi->status }}</option>
                <option value="ON">ON </option>
                <option value="Maintance">Maintance</option>
                <option value="OFF">OFF</option>
            </select>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan"
                       required>{{ $maplikasi->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label>Tanggal Fix</label>
        <input type="text" id="tgl_fix" name="tgl_fix" value="{{ $maplikasi->tgl_fix }}">
        </div>
        <input type="hidden" id="idaplikasi" name="idaplikasi" value="{{ $maplikasi->maplikasi_id }}">
        <input type="hidden" id="id_induk" name="id_induk" value="{{ $maplikasi->id_aplikasi }}">
      <div>
            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Kirim</strong></button>
        </div>
    </form>
</div>

<script>
    $('#tgl_fix').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
</script>
<p></p>

