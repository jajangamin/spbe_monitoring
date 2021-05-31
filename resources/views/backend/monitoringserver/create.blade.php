<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.monitoringserver.create') }}" method="post">
        @csrf
        <div class="form-group">

            {{--            <p>Nama Aplikasi : <strong>{{ $mserver->nama_server }}</strong></p>--}}
            {{--            <p>Link : <strong>{{ $mserver->link}}</strong></p>--}}
            {{--            <p>Unit Kerja : <strong>{{ $mserver->nama_unit }}</strong></p>--}}
            {{--            <p>status : <strong>{{ $mserver->status }}</strong></p>--}}
        </div>

        <div class="form-group">
            <label>Nama Server</label>
            <select class="form-control" name="nama_server" id="nama_server" required>
                <option value="" selected disabled>-- Pilih Server --</option>
                <option value="Server 1">Server 1 </option>
                <option value="Server 2">Server 2</option>
                <option value="Server 3">Server 3</option>

            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Error</label>
            <input type="text" id="tgl_error" name="tgl_error"  value={{date('Y-m-d H:i:s')}} required>
        </div>

        <div class="form-group">
            <label>Tanggal Fix</label>
            <input type="text" id="tgl_fix" name="tgl_fix" value={{date('Y-m-d H:i:s')}}  required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan"
                      required></textarea>
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

