<form action="{{ route('backend.kuota.update') }}" method="post">
    @csrf
    <input type="hidden" id="id" name="id" value="{{ $counter->id }}">
    <div class="form-group"><label>Nama Dokter: </label> {{ $counter->detailjadwal->detaildokter->namalengkap }}</div>
    <div class="form-group"><label>Tanggal Praktek: </label> {{ $counter->tanggalpraktek.', '.date('H:i',strtotime($counter->detailjadwal->jampraktek_awal)).' - '.date('H:i',strtotime($counter->detailjadwal->jampraktek_akhir)) }}</div>
    <div class="form-group"><label>Kuota Terisi: </label> {{ $counter->sequence }}</div>
    <div class="form-group"><label>Kuota*</label> <input type="text" id="kuota" name="kuota" class="form-control" required value="{{$counter->kuota}}"></div>
    <input type="hidden" name="statuskuota" id="statuskuota" value="" />
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit" onClick="changeKuota(1)"><strong>Set Penuh</strong></button>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" onClick="changeKuota(0)"><strong>Ubah</strong></button>
        </div>
    </div>
</form>

<script>
    function changeKuota(id){
        $("#statuskuota").val(id);
    }
</script>
