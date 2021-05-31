<style>
    .clockpicker-popover {
        z-index: 999999 !important;
    }
</style>
<form action="{{ route('backend.master.jadwaledit') }}" method="post">
    @csrf
    <input type="hidden" id="jadwal_id" name="jadwal_id" value="{{ $jadwal->id }}">
    <div class="form-group">
        <label>Pilih Dokter*</label>
        <select class="form-control m-b" id="dokter" name="dokter">
            @foreach ($dokter as $data => $value)
            <option value="{{ $value->id }}" {{ $value->id == $jadwal->dokter ? 'selected' : '' }}>{{ $value->kodedokter .' - '. $value->namalengkap }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pilih Poliklinik*</label>
        <select class="form-control m-b" id="idpoliklinik" name="idpoliklinik">
            @foreach ($poliklinik as $data => $value)
                <option value="{{ $value->id }}" {{ $value->id == $jadwal->idpoliklinik ? 'selected' : '' }}>{{ $value->kodepoli .' - '. $value->namapoliklinik }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group clockpicker" data-autoclose="true">
                <label>Jam Mulai*</label>
                <input type="text" id="jampraktek_awal" name="jampraktek_awal" class="form-control"
                       value="{{ date('H:i',strtotime($jadwal->jampraktek_awal)) }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group clockpicker" data-autoclose="true">
                <label>Jam Berakhir*</label>
                <input type="text" id="jampraktek_akhir" name="jampraktek_akhir" class="form-control"
                       value="{{ date('H:i',strtotime($jadwal->jampraktek_akhir)) }}" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Hari*</label>
        <select class="form-control m-b" id="hari" name="hari">
            <option value="SENIN" {{ $jadwal->hari == 'SENIN' ? 'selected' : '' }}>SENIN</option>
            <option value="SELASA" {{ $jadwal->hari == 'SELASA' ? 'selected' : '' }}>SELASA</option>
            <option value="RABU" {{ $jadwal->hari == 'RABU' ? 'selected' : '' }}>RABU</option>
            <option value="KAMIS" {{ $jadwal->hari == 'KAMIS' ? 'selected' : '' }}>KAMIS</option>
            <option value="JUMAT" {{ $jadwal->hari == 'JUMAT' ? 'selected' : '' }}>JUMAT</option>
            <option value="SABTU" {{ $jadwal->hari == 'SABTU' ? 'selected' : '' }}>SABTU</option>
            <option value="MINGGU" {{ $jadwal->hari == 'MINGGU' ? 'selected' : '' }}>MINGGU</option>
        </select>
    </div>
    <div class="form-group">
        <label>Waktu Praktek*</label>
        <select class="form-control m-b" id="waktupraktek" name="waktupraktek">
            <option value="PAGI" {{ $jadwal->waktupraktek == 'PAGI' ? 'selected' : '' }}>PAGI</option>
            <option value="SIANG" {{ $jadwal->waktupraktek == 'SIANG' ? 'selected' : '' }}>SIANG</option>
            <option value="SORE" {{ $jadwal->waktupraktek == 'SORE' ? 'selected' : '' }}>SORE</option>
            <option value="MALAM" {{ $jadwal->waktupraktek == 'MALAM' ? 'selected' : '' }}>MALAM</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kuota Pasien*</label>
        <input type="text" id="kuotapasien" name="kuotapasien" class="form-control" value="{{ $jadwal->kuotapasien }}"
               required>
    </div>
    <div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
    });
</script>
