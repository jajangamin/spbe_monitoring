<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.monitoringjaringan.kirimstatus') }}" method="post">
        @csrf
        <div class="form-group">

            <p>OPD  : <strong>{{ $mjaringan->opd }}</strong></p>
            <p>IP : <strong>{{ $mjaringan->ip}}</strong></p>
            <p>Bandwidth : <strong>{{ $mjaringan->bandwitch }}</strong></p>
            <p>status : <strong>{{ $mjaringan->status }}</strong></p>
        </div>

        <div class="form-group">
            <label>Ubah Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value={{ $mjaringan->status }} selected >{{ $mjaringan->status }}</option>
                <option value="UP">UP </option>
                <option value="DOWN">DOWN</option>
                <option value="OFF">OFF</option>
            </select>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan"
                       required>{{ $mjaringan->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label>Tanggal Fix</label>
        <input type="text" id="tgl_fix" name="tgl_fix" value="{{ $mjaringan->tgl_fix }} ">
        </div>
        <input type="hidden" id="idjaringan" name="idjaringan" value="{{ $mjaringan->mjaringan_id }}">
        <input type="hidden" id="jaringan_id" name="jaringan_id" value="{{ $mjaringan->jaringan_id }}">
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

