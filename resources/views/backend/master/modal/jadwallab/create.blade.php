<style>
    .clockpicker-popover {
        z-index: 999999 !important;
    }
</style>
<form action="{{ route('backend.master.jadwallabcreate') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Pilih Lab*</label>
        <select class="form-control m-b" id="lab" name="lab" required>
            @foreach ($lab as $data => $value)
                <option value="{{ $value->id }}">{{ $value->kodelab .' - '. $value->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group clockpicker" data-autoclose="true">
                <label>Jam Mulai*</label>
                <input type="text" id="jampraktek_awal" name="jampraktek_awal" class="form-control"
                       value="" autocomplete="off" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group clockpicker" data-autoclose="true">
                <label>Jam Berakhir*</label>
                <input type="text" id="jampraktek_akhir" name="jampraktek_akhir" class="form-control"
                       value="" autocomplete="off" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Hari*</label>
        <select class="form-control m-b" id="hari" name="hari" required>
            <option value="SENIN">SENIN</option>
            <option value="SELASA">SELASA</option>
            <option value="RABU">RABU</option>
            <option value="KAMIS">KAMIS</option>
            <option value="JUMAT">JUMAT</option>
            <option value="SABTU">SABTU</option>
            <option value="MINGGU">MINGGU</option>
        </select>
    </div>
    <div class="form-group">
        <label>Waktu Praktek*</label>
        <select class="form-control m-b" id="waktupraktek" name="waktupraktek" required>
            <option value="PAGI">PAGI</option>
            <option value="SIANG">SIANG</option>
            <option value="SORE">SORE</option>
            <option value="MALAM">MALAM</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kuota*</label>
        <input type="number" id="kuota" name="kuota" class="form-control text-right" value="1" min="0" required>
    </div>
    <div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
    });
</script>
