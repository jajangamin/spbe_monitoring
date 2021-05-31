<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.monitoringserver.kirimstatus') }}" method="post">
        @csrf
        <div class="form-group">

            <p>Nama Server  : <strong>{{ $mserver->nama_server }}</strong></p>

        </div>

        <div class="form-group">
            <label>Tanggal Error</label>
            <input type="text" id="tgl_error" name="tgl_error" value="{{ $mserver->tgl_error }} ">
        </div>

        <div class="form-group">
            <label>Tanggal Fix</label>
            <input type="text" id="tgl_fix" name="tgl_fix" value="{{ $mserver->tgl_fix }} ">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan"
                       required>{{ $mserver->keterangan }}</textarea>
        </div>



        <input type="hidden" id="idserver" name="idserver" value="{{ $mserver->mserver_id }}">
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

